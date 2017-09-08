:start1
@ECHO OFF
TITLE Easy Apk Dissasembler by ORioN
CLS
ECHO.
ECHO Easy Apk Disassembler by:
ECHO    ___  ____  _       _   _  
ECHO   / _ \^|  _ \(_) ___ ^| \ ^| ^|
ECHO  ^| ^| ^| ^| ^|_) ^| ^|/ _ \^|  \^| ^|
ECHO  ^| ^|_^| ^|  _  ^| ^| (_) ^| ^|\  ^| 
ECHO   \___/^|_^| \_\_^|\___/^|_^| \_^| 
ECHO.                    
ECHO.
ECHO. 
ECHO (0) Apktool Dissasembly
ECHO (1) Apktool Assembly
ECHO (2) DISASSEMBLY a classes.dex with smali
ECHO (3) ASSEMBLY a classes.dex with baksmali
ECHO (4) Sign an APK
ECHO (5) Convert an Xml Binairy to Xml
ECHO (6) Launch CMD
ECHO (7) Launch Notepad++
ECHO (8) About
ECHO (9) EXIT
ECHO.
set INPUT=
set /P INPUT=Please enter the number of your choice: %=%
if "%INPUT%"=="exit" goto yesend
if "%INPUT%"=="0" goto apktool
if "%INPUT%"=="1" goto apktoolcompile
if "%INPUT%"=="2" goto decompile
if "%INPUT%"=="3" goto compile
if "%INPUT%"=="4" goto signapk
if "%INPUT%"=="5" goto xmlconvert
if "%INPUT%"=="6" cmd
if "%INPUT%"=="7" goto notepadpp
if "%INPUT%"=="8" goto about
if "%INPUT%"=="9" goto yesend

goto start1
:apktool
set /P FICHIER=Enter the name of the file to dissasembly (ex: Name.apk) : %=%
java -jar SYSTEM.EAD/apktool.jar d %FICHIER% dis_%FICHIER%
goto end

:apktoolcompile
set /P FICHIER=Enter the name of the folder to assembly (ex: dis_Name.apk) : %=%
java -jar SYSTEM.EAD/apktool.jar b %FICHIER%
java -jar SYSTEM.EAD/signapk.jar SYSTEM.EAD/testkey.x509.pem SYSTEM.EAD/testkey.pk8 %FICHIER%/dist/%FICHIER:~4% %FICHIER%/dist/signed_%FICHIER:~4%
java -jar SYSTEM.EAD/signapk.jar SYSTEM.EAD/nthienphuong.pem SYSTEM.EAD/nthienphuong.pk8 %FICHIER%/dist/%FICHIER:~4% %FICHIER%/dist/signed_%FICHIER:~4%

#ECHO I: jarsigner %FICHIER:~4%
#"C:\Program Files\Java\jdk1.7.0_07\bin\jarsigner" -sigalg SHA1withRSA -digestalg SHA1 -keystore nguyenthienphuong.android.key -keypass @phuongntinet -storepass @phuongntinet project/%FICHIER%/dist/%FICHIER:~4% nguyenthienphuong
#ECHO I: zipalign %FICHIER:~4% to release_%FICHIER:~4%
#zipalign.exe -f 4 project/%FICHIER%/dist/%FICHIER:~4% project/%FICHIER%/dist/release_%FICHIER:~4%
#ECHO I: delete %FICHIER:~4%
#del project\%FICHIER%\dist\%FICHIER:~4%
#ECHO I: rename release_%FICHIER:~4% to %FICHIER:~4%
#rename project\%FICHIER%\dist\release_%FICHIER:~4% %FICHIER:~4%

explorer %FICHIER%\dist\
goto end

:signapk
set /P FICHIER=Enter the name of the file (ex: Name.apk) : %=%
java -jar SYSTEM.EAD/signapk.jar SYSTEM.EAD/testkey.x509.pem SYSTEM.EAD/testkey.pk8 %FICHIER% signed_%FICHIER%
goto end

:compile
set /P EXPORT=In witch folder do you want to COMPILE a .dex file : out_%=%
java -Xmx512m -jar SYSTEM.EAD/smali-1.2.2.jar out_%EXPORT%
goto end


:decompile
set /P EXPORT=In witch folder do you want that this classes.dex will be DISSASSEMBLY : %=%
java -Xmx512m -jar SYSTEM.EAD/baksmali-1.2.2.jar --output out_%EXPORT% classes.dex
goto end


:xmlconvert
set /P FConvert=Enter the name of a binarie xml file to convert : %=%
java -jar SYSTEM.EAD/AXMLprinter2.jar %FConvert% > out_%FConvert%
goto end


:notepadpp
start SYSTEM.EAD\unicode\notepad++.exe
goto end

:about
CLS
ECHO ******* Easy Apk Decompiler ********
ECHO ********* By ORioN **********
ECHO.
ECHO Please read the Licence.txt
ECHO.
ECHO *Smali and Baksmali by JesusFreke's (New BSD License)
ECHO *Apktool by  brut.all (Apache License 2.0)
ECHO *Dedexer by gaborpaller (public domain)
ECHO *AXMLPrinter2 by Android4ME 
ECHO *Auto-Sign by damnitpud from Xda
ECHO *Notepad++ Licence GPL 
ECHO.
PAUSE
goto start1

:end
PAUSE
goto :start1