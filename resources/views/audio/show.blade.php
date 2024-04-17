@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('assets/index.css')}}">
    <script src="https://unpkg.com/wavesurfer.js"></script>
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{$audio->origin_name}}</h4>
                </div>
                <div class="header-action">
                    <i data-toggle="collapse" data-target="#form-element-1" aria-expanded="false">
                        <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </i>
                </div>
            </div>
            <div class="card-body">
                <div class="collapse" id="form-element-1">
                    <div class="card"></div>
                </div>
                <div>
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                            </div>
                            <div class="card-body" id="textCardBody">

                                <h5 class="text-center">Text</h5>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="music-player">
                            <div class="music-container">
                                <div class="music-info">

                                    <div class="info">
                                        <h3>Vocal</h3>
                                        <div id="waveform" ></div>
                                        <div class="control-bar">
                                            <img src="{{asset('assets/play-buttton.png')}}" alt="play" class="playBtn" id="playBtn1" title="Play / Pause">
                                            <img src="{{asset('assets/stop-button.png')}}" alt="stop" class="stopBtn" id="stopBtn1" title="Stop">
                                            <input type="range" class="volumeRange" id="volumeRange1" min="0" max="15" step="1" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="music-container">
                                <div class="music-info">

                                    <div class="info">
                                        <h3>Music</h3>
                                        <div id="waveform2"></div>
                                        <div class="control-bar">
                                            <img src="{{asset('assets/play-buttton.png')}}" alt="play" class="playBtn" id="playBtn2" title="Play / Pause">
                                            <img src="{{asset('assets/stop-button.png')}}" alt="stop" class="stopBtn" id="stopBtn2" title="Stop">
                                            <input type="range" class="volumeRange" id="volumeRange2" min="0" max="15" step="1" value="5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-bar">
                                <img src="{{asset('assets/play-buttton.png')}}" alt="play" class="playBtn" id="playBtnAll" title="Play / Pause">
                                <img src="{{asset('assets/stop-button.png')}}" alt="stop" class="stopBtn" id="stopBtnAll" title="Stop">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        let text = [];
        let audio_id = "{{$audio->id}}";
        let playBtn1 = document.getElementById("playBtn1");
        let stopBtn1 = document.getElementById("stopBtn1");
        let volumeRange1 = document.getElementById("volumeRange1");

        let playBtn2 = document.getElementById("playBtn2");
        let stopBtn2 = document.getElementById("stopBtn2");
        let volumeRange2 = document.getElementById("volumeRange2");

        let playBtnAll = document.getElementById("playBtnAll");
        let stopBtnAll = document.getElementById("stopBtnAll");


        let wavesurfer1 = WaveSurfer.create({
            container: '#waveform',
            waveColor: '#3de4cc',
            progressColor: '#2aadf4',
            barWidth: 3,
            responsive: true,
            hideScrollbar: true,
            barRadius: 3
        });
        wavesurfer1.load("{{asset('storage/'.$audio->audio_noise)}}");

        let wavesurfer2 = WaveSurfer.create({
            container: '#waveform2',
            waveColor: '#2aadf4',
            progressColor: '#4cbcec',
            barWidth: 3,
            responsive: true,
            hideScrollbar: true,
            barRadius: 3
        });
        wavesurfer2.load("{{asset('storage/'.$audio->audio_voice)}}");

        playBtn1.onclick = function(){
            wavesurfer1.playPause();
            if(playBtn1.src.match("play")){
                playBtn1.src  = "{{asset('assets/pause.png')}}";
            }
            else{
                playBtn1.src = "{{asset('assets/play-buttton.png')}}"
            }
        }

        stopBtn1.onclick = function(){
            wavesurfer1.stop();
            playBtn1.src = "{{asset('assets/play-buttton.png')}}"
        }

        volumeRange1.oninput = function(){
            let volume = parseInt(this.value) / 15;
            wavesurfer1.setVolume(volume);
        }

        playBtn2.onclick = function(){
            wavesurfer2.playPause();
            if(playBtn2.src.match("play")){
                playBtn2.src  = "{{asset('assets/pause.png')}}";
            }
            else{
                playBtn2.src = "{{asset('assets/play-buttton.png')}}"
            }
        }

        stopBtn2.onclick = function(){
            wavesurfer2.stop();
            playBtn2.src = "{{asset('assets/play-buttton.png')}}"
        }

        volumeRange2.oninput = function(){
            let volume = parseInt(this.value) / 15;
            wavesurfer2.setVolume(volume);
        }

        playBtnAll.onclick = function() {
            wavesurfer1.playPause();
            wavesurfer2.playPause();
            if (playBtnAll.src.match("play")) {
                playBtnAll.src = "{{asset('assets/pause.png')}}";
                playBtn1.src = "{{asset('assets/pause.png')}}";
                playBtn2.src = "{{asset('assets/pause.png')}}";
            } else {
                playBtnAll.src = "{{asset('assets/play-buttton.png')}}";
                playBtn1.src = "{{asset('assets/play-buttton.png')}}";
                playBtn2.src = "{{asset('assets/play-buttton.png')}}";
            }
        }

        stopBtnAll.onclick = function() {
            wavesurfer1.stop();
            wavesurfer2.stop();
            playBtnAll.src = "{{asset('assets/play-buttton.png')}}";
            playBtn1.src = "{{asset('assets/play-buttton.png')}}";
            playBtn2.src = "{{asset('assets/play-buttton.png')}}";
        }



        {{--fetch(`/audios/get/text/${audio_id}`, {--}}
        {{--    headers:{--}}
        {{--        'X-CSRF-TOKEN': "{{csrf_token()}}"--}}
        {{--    }--}}
        {{--})--}}
        {{--    .then(response => response.json())--}}
        {{--    .then()--}}
    </script>
@endsection
