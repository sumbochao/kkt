#!/bin/sh
cd /home/webhome/kenhkiemtien.com/java_cront/game
java -Xms128M -Xmx512M -cp /home/webhome/kenhkiemtien.com/java_cront/game:./com.hdc.wapcontent.generator1.jar com.hdc.thread.JBGameBuildsFilesThread >> /home/webhome/kenhkiemtien.com/java_cront/game/game.log &
