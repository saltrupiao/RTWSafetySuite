import numpy as np
import cv2

cap = cv2.VideoCapture(0)
# out = cv2.VideoWriter('output.avi', -1, 20.0, (640,480))
fourcc = cv2.VideoWriter_fourcc(*'XVID')
out = cv2.VideoWriter('output.avi', fourcc, 2.0, (int(cap.get(3)), int(cap.get(4))))
      	
while(cap.isOpened()):
    ret, frame = cap.read()
    if ret==True:
        # frame = cv2.flip(frame,0)
        out.write(frame)
        cv2.imshow('frame',frame)
        if cv2.waitKey(1) & 0xFF == ord('q'):
            break
    else:
        break

cap.release()
out.release()
cv2.destroyAllWindows()
