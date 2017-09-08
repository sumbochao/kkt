#!/bin/sh
cd /home/webhome/kenhkiemtien.com/java_cront/app
java -Xms128M -Xmx512M -cp /home/webhome/kenhkiemtien.com/java_cront/app/:./com.hdc.wapcontent.generator1.jar com.hdc.thread.AppBuildsFilesThread >> /home/webhome/kenhkiemtien.com/java_cront/app/app.log &
