vlc v4l2:// :input-slave=alsa:// :v4l-vdev="/dev/video0" :v4l-norm=3 :v4l-frequency=-1 :v4l-caching=300 :v4l-chroma="" :v4l-fps=-1.000000 :v4l-samplerate=44100 :v4l-channel=0 :v4l-tuner=-1 :v4l-audio=-1 :v4l-stereo :v4l-width=480 :v4l-height=360 :v4l-brightness=-1 :v4l-colour=-1 :v4l-hue=-1 :v4l-contrast=-1 :no-v4l-mjpeg :v4l-decimation=1 :v4l-quality=100 --sout="#transcode{vcodec=h264,scale=Auto,width=1920,height=1080,acodec=mpga,ab=128,channels=2,samplerate=44100,scodec=none}:file{dst=/home/reed/Desktop/social-distance-detector/test5.mp4,no-overwrite}"