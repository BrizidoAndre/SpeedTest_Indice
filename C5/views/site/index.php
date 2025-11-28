<?php

/** @var \app\models\Artist [] $artists */
/** @var \app\models\Song [] $songs */
$artist = \app\models\Artist::find()->all();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
    <link rel="stylesheet" href="/modulo_a_SP_V2/C5/assets/css/bootstrap.min.css">
</head>
<body>
<header class="bg-secondary text-white w-100 py-3 top-0 start-0 z-1">
    <div class="container d-flex align-items-center justify-content-between">
        <h1>Song Player 3000</h1>
        <ul class="d-flex gap-3 list-unstyled">
            <li class="text-black">
                <!-- UPLOAD SONG FORM MODAL-->
                <div class="modal fade" id="upload-new-song-modal" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1"
                     aria-labelledby="upload-new-song-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="upload-new-song-modal-label">Upload new song!</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= \yii\helpers\Url::to(['site/song']) ?>"
                                      enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="song-title" class="form-label">Song title</label>
                                        <input class="form-control" id="song-title" type="text" name="song-title"
                                               placeholder="Insert song title...">
                                    </div>
                                    <div class="mb-3">
                                        <label for="song-artist" class="form-label">Artist</label>
                                        <select class="form-select" id="song-artist" type="text" name="song-artist"
                                                required>
                                            <option selected disabled value="0">Select song artist...</option>
                                            <?php foreach ($artist as $item) : ?>
                                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="song-file" class="form-label">Song file</label>
                                        <input class="form-control" id="song-file" type="file" name="song-song"
                                               placeholder="Insert song file...">
                                        <p class="form-text">A .mp3 file</p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cover-file" class="form-label">Cover file</label>
                                        <input class="form-control" id="cover-file" type="file" name="song-cover"
                                               placeholder="Insert song file...">
                                        <p class="form-text">A .png file</p>
                                    </div>
                                    <button class="btn btn-primary mt-5" type="submit">Upload</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- UPLOAD SONG FORM MODAL - END -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#upload-new-song-modal">
                    Upload new song
                </button>
            </li>
            <li class="text-black">
                <!-- ADD ARTIST MODAL-->
                <div class="modal fade" id="add-artist-modal" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1"
                     aria-labelledby="upload-new-song-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="add-artist-modal-label">Add new artist!</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= \yii\helpers\Url::to(['site/artist']) ?>">
                                    <div class="mb-3">
                                        <label for="artist-name" class="form-label">Artist Name</label>
                                        <input class="form-control" id="artist-name" type="text" name="song-title"
                                               placeholder="Insert artist name..."/>
                                    </div>
                                    <button class="btn btn-primary mt-5" type="submit">Save</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ADD ARTIST MODAL - END -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-artist-modal">
                    Add new artist
                </button>
            </li>
        </ul>
    </div>
</header>
<main class="w-100 flex-grow-0 flex-shrink-1 overflow-hidden" style="width: auto; height: auto">
    <div class="container py-5 w-100 h-100">
        <div class="row w-100 h-100 justify-content-between">
            <section class="col col-4 h-100 d-flex align-items-center justify-content-center">
                <article class="card rounded-5 h-100 w-100">
                    <header class="card-header">
                        <h2 id="song-name">Song Name</h2>
                        <p id="artist-name">Artist name</p>
                    </header>
                    <div class="card-body h-75 d-flex flex-column align-items-center justify-content-center p-5">
                        <img class="border-1 border border-primary-subtle object-fit-cover rounded-5"
                             style="max-width: 150px; aspect-ratio: 1 / 1"
                             src="assets/images/default-cover.jpg" alt="Default song cover"/>
                        <div class="progress w-50 mt-5" style="height: 10px;">
                            <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 50%;"
                                 aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <audio id="audio" style="display: none" src="assets/songs_files/1/1.mp3"></audio>
                    <footer class="card-footer d-flex align-items-center justify-content-center">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button id="previous" type="button" class="btn btn-primary"><img
                                        style="width: 20px; height: 20px; filter: invert(1)"
                                        src="assets/icons/backward-solid.svg" alt/></button>
                            <button id="current" type="button" class="btn btn-primary"><img
                                        style="width: 20px; height: 20px; filter: invert(1)"
                                        src="assets/icons/play-solid.svg" alt/></button>
                            <button id="next" type="button" class="btn btn-primary"><img
                                        style="width: 20px; height: 20px; filter: invert(1)"
                                        src="assets/icons/forward-solid.svg" alt/></button>
                        </div>
                    </footer>
                </article>
            </section>
            <section class="col col-4 h-100">
                <h2>Avaiable artists</h2>
                <div class="overflow-y-scroll py-3" style="max-height: 60vh">
                    <?php foreach ($artists

                                   as $artist) : ?>
                        <article class="card mw-100 mb-4 py-3 px-3">
                            <h3><?= $artist->name ?></h3>
                            <h4>Songs</h4>
                            <?php foreach ($artist->songs as $id => $song): ?>
                                <div class="d-flex align-items-start flex-column gap-3">
                                    <article class="card mw-100 mb-2">
                                        <div class="row g-0">
                                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                                <img src="assets/images/default-cover.jpg"
                                                     class="img-fluid rounded-4 ms-3 border border-primary-subtle border-1"
                                                     alt="Default cover image">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h3 class="card-title"><?= $song->title ?></h3>
                                                    <button data-name="<?= $song->title ?>"
                                                            data-artist="<?= $song->artist->name ?>"
                                                            data-src="<?= ($song->id) ?>" type="button"
                                                            class="btn btn-sm btn-primary btn-songs"><img
                                                                style="width: 10px; height: 10px; filter: invert(1)"
                                                                src="assets/icons/play-solid.svg" alt/></button>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; ?>
                        </article>
                    <?php endforeach ?>
                </div>
            </section>
            <section class="col col-4 h-100">
                <h2>Library</h2>
                <div class="overflow-y-scroll py-3" style="max-height: 60vh">
                    <?php foreach ($songs as $id => $song) : ?>
                        <article class="card mw-100 mb-4">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <img src="assets/images/default-cover.jpg"
                                         class="img-fluid rounded-4 ms-3 border border-primary-subtle border-1"
                                         alt="Default cover image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h3 class="card-title"><?= $song->title ?></h3>
                                        <p><?= $song->artist->name ?></p>
                                        <button data-name="<?= $song->title ?>"
                                                data-artist="<?= $song->artist->name ?>"
                                                data-src="<?= (++$id) ?>"
                                                type="button"
                                                class="btn btn-sm btn-primary btn-songs"><img
                                                    style="width: 10px; height: 10px; filter: invert(1)"
                                                    src="assets/icons/play-solid.svg" alt/></button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>
</main>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    let buttons = document.querySelectorAll('.btn-songs')
    let artistName = document.getElementById('artist-name');
    let songName = document.getElementById('song-name');
    let progressBar = document.getElementById('progress-bar');

    let audio = document.getElementById('audio')

    let btnCurrent = document.getElementById('current');
    let btnNext = document.getElementById('next');
    let btnPrev = document.getElementById('previous');

    const imagesPath = 'assets/songs_files/';

    buttons.forEach(btn => {
        let id = btn.dataset.src;
        let artist = btn.dataset.artist;
        let name = btn.dataset.name;
        btn.addEventListener('click', () => {
            artistName.innerHTML = artist;
            songName.innerHTML = name;
            progressBar.style.width = '0%';
            audio.src = imagesPath + id + '/' + id + '.mp3';
            audio.play();
            btnCurrent.querySelector('img').src = urlPausedImage;
        })
    })

    const urlPlayImage = 'assets/icons/play-solid.svg';
    const urlPausedImage = 'assets/icons/pause-solid.svg';

    btnCurrent.addEventListener('click', (ev) => {
        if (audio.paused) {
            audio.play();
            btnCurrent.querySelector('img').src = urlPausedImage;
        } else {
            audio.pause();
            btnCurrent.querySelector('img').src = urlPlayImage;
        }
    })

    audio.addEventListener('timeupdate', (ev) => {
        let progress = audio.currentTime;
        progressBar.style.width = ((100 * progress) / audio.duration) + '%';
    })
    btnPrev.addEventListener('click', () => {
        audio.currentTime = 0;
        progressBar.style.width = '0%';
    })
    btnNext.addEventListener('click', () => {
        audio.playbackRate = audio.playbackRate === 1 ? 2 : 1;
    })
</script>
</body>
</html>
