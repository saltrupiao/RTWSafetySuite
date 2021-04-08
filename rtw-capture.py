import threading
import time
from datetime import datetime
import os
import signal
import subprocess


def dt():
    currentDateTime = datetime.now()
    date_fmt = currentDateTime.strftime("%m-%d--%H-%M-%S")
    return date_fmt


def capture():
    while True:
        print("In while loop")

        curDateTime = dt()

        fn = "capture-" + curDateTime + ".mp4"
        # Command base source: https://unix.stackexchange.com/questions/58526/trouble-getting-vlc-to-record-from-the-webcam-via-command-line
        vlcCmd1 = 'vlc v4l2:// :input-slave=alsa:// :v4l-vdev="/dev/video0" :v4l-norm=3 :v4l-frequency=-1 :v4l-caching=300 :v4l-chroma="" :v4l-fps=-1.000000 :v4l-samplerate=44100 :v4l-channel=0 :v4l-tuner=-1 :v4l-audio=-1 :v4l-stereo :v4l-width=480 :v4l-height=360 :v4l-brightness=-1 :v4l-colour=-1 :v4l-hue=-1 :v4l-contrast=-1 :no-v4l-mjpeg :v4l-decimation=1 :v4l-quality=100 --sout="#transcode{vcodec=h264,scale=Auto,width=1920,height=1080,acodec=mpga,ab=128,channels=2,samplerate=44100,scodec=none}:file{dst=/home/reed/Desktop/social-distance-detector/input_videos/'
        vlcCmd2 = fn
        vlcCmd3 = ',no-overwrite}"'
        vlcCmdFull = vlcCmd1 + vlcCmd2 + vlcCmd3
        print(vlcCmdFull)

        recordCmd = subprocess.Popen(vlcCmdFull, stdout=subprocess.PIPE, shell=True, preexec_fn=os.setsid)

        print("Sleeping for 30 seconds...")
        time.sleep(30)
        print("Sleeping for 30 seconds done!")
        os.killpg(os.getpgid(recordCmd.pid), signal.SIGTERM)
        print("Cooldown of 5 seconds")
        time.sleep(10)


        print("executing detection commands!")
        fnSize = len(fn)
        fnOutput = "/home/reed/Desktop/social-distance-detector/output_videos/" + fn[:fnSize-4] + ".avi"
        detectionCmd = "time python3 social_distance_detector.py --input /home/reed/Desktop/social-distance-detector/input_videos/" + fn + " --output " + fnOutput
        print("DetectionCMD: ", detectionCmd)
        # subprocess.call("test.sh", shell=True, preexec_fn=os.setsid)
        os.system(detectionCmd)
        # print("Executing Detection Command:", detectionCmd)


        print("Sleeping for 25 seconds...")
        time.sleep(25)
        print("Sleeping for 25 seconds done!")



def main():
    threadCapture = threading.Thread(target=capture, args=())
    threadCapture.start()


main()