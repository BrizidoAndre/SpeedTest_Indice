<?php

namespace app\controllers;

use app\models\Artist;
use app\models\Song;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $songs = Song::find()->all();
        $artists = Artist::find()->all();
        return $this->renderPartial('index', [
            'artists' => $artists,
            'songs' => $songs
        ]);
    }

    /**
     * Creates an artist.
     *
     * @return
     */
    public function actionArtist()
    {
        $artist = new Artist();
        $artist->name = $this->request->getBodyParam('song-title');
        $artist->save();
        return $this->redirect(['site/index']);
    }

    /**
     * Creates an artist.
     *
     * @return
     */
    public function actionSong()
    {
        $files = FileHelper::findDirectories('./assets/songs_files');
        $indexSong = count($files) + 1;
        FileHelper::createDirectory("./assets/songs_files/$indexSong");
        $cover = UploadedFile::getInstanceByName('song-cover');
        $cover->saveAs("./assets/songs_files/$indexSong/$indexSong" . '.' . $cover->getExtension());
        $song = UploadedFile::getInstanceByName('song-song');
        $song->saveAs("./assets/songs_files/$indexSong/$indexSong" . '.' . $song->getExtension());
        $newSong = new Song();
        $newSong->title = $this->request->getBodyParam('song-title');
        $newSong->artist_id = $this->request->getBodyParam('song-artist');
        $newSong->save();
        return $this->redirect(['site/index']);;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
