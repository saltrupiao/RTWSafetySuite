import threading
import time
from datetime import datetime


def dt():
    currentDateTime = datetime.now()
    date_fmt = currentDateTime.strftime("%m-%d--%H:%M:%S")
    return date_fmt


def capture():
    while True:
        curDateTime = dt()
        time.sleep(3)
        print("In while loop")


def main():
    threadCapture = threading.Thread(target=capture, args=())
    threadCapture.start()


main()