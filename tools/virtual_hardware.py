import requests 
import time
import sys

def anim():
    for i in range(30):
        sys.stdout.write(">")
        sys.stdout.flush()
        time.sleep(0.1)
    print()

def readRGB():
    r=int(input("Enter R reading: "))
    g=int(input("Enter G reading: "))
    b=int(input("Enter B reading: "))
    return (r,g,b)

def testN():
    r,g,b=readRGB()
    if (220<=r<=260) and (100<=g<=140) and (200<=b<=240):
        return 1
    elif(220<=r<=260) and (120<=g<=160) and (200<=b<=240):
        return 2
    elif(220<=r<=260) and (160<=g<=200) and (200<=b<=240):
        return 3
    elif(220<=r<=260) and (180<=g<=220) and (220<=b<=260):
        return 4
    elif(220<=r<=260) and (200<=g<=240) and (220<=b<=260):
        return 5
    else:
        print("Invalid Values")
        return 0

def testP():
    r,g,b=readRGB()
    if (40<=r<=80) and (140<=g<=180) and (200<=b<=240):
        return 1
    elif(100<=r<=140) and (180<=g<=220) and (220<=b<=260):
        return 2
    elif(140<=r<=180) and (200<=g<=240) and (220<=b<=260):
        return 3
    elif(180<=r<=220) and (200<=g<=240) and (220<=b<=260):
        return 4
    elif(200<=r<=240) and (220<=g<=260) and (220<=b<=260):
        return 5
    else:
        print("Invalid Values")
        return 0

def testK():
    r,g,b=readRGB()
    if (160<=r<=200) and (40<=g<=80) and (0<=b<=40):
        return 1
    elif(200<=r<=240) and (80<=g<=120) and (20<=b<=60):
        return 2
    elif(240<=r<=280) and (150<=g<=190) and (80<=b<=120):
        return 3
    elif(230<=r<=270) and (180<=g<=220) and (120<=b<=160):
        return 4
    elif(220<=r<=260) and (200<=g<=240) and (160<=b<=200):
        return 5
    else:
        print("Invalid Values")
        return 0

def classifier(value):
    values=["Surplus","Sufficient","Adequate","Deficient","Depleted"]
    value-=1
    return values[value]


device_id=int(input("Enter device ID Ex:127001: "))

print("Virtual Soil Tester")
print("Device id: {}".format(device_id))
print("Loading: ",end="")
anim()
print("Testing Nitrogen contents")
while(1):
    n=testN()
    if(n==0):
        continue
    else:
        print("Nitrogen is {} in this soil".format(classifier(n)))
        break

print("Testing Phosphorous contents")
while(1):
    p=testP()
    if(p==0):
        continue
    else:
        print("Phosphorous is {} in this soil".format(classifier(p)))
        break

print("Testing Pottasium contents")
while(1):
    k=testK()
    if(k==0):
        continue
    else:
        print("Pottasium is {} in this soil".format(classifier(k)))
        break

ph=float(input("Enter pH reading: "))
moisture=int(input("Enter moisture value: "))
data={}
data['device']=device_id
data['n']=n
data['p']=p
data['k']=k
data['ph']=ph
data['moisture']=moisture
print("Sending data to server")
print("Uploading: ",end="")
anim()
req=requests.post('http://127.0.0.1/save.php',data=data)
print(req.text)
