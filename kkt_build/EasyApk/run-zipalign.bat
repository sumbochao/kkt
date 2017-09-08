:start1
@ECHO OFF
set INPUT=
set /P INPUT=Nhap file apk muong zipalign (ex: Name.apk) : %=%
zipalign.exe -f 4 signer/%INPUT% signer/release/%INPUT%
PAUSE
goto :start1