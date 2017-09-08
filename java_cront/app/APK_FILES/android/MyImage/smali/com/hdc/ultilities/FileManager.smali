.class public Lcom/hdc/ultilities/FileManager;
.super Ljava/lang/Object;
.source "FileManager.java"


# direct methods
.method public constructor <init>()V
    .locals 0

    .prologue
    .line 20
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method

.method public static fileIsExits(Ljava/lang/String;)Z
    .locals 5
    .parameter "filename"

    .prologue
    const/4 v3, 0x0

    .line 24
    new-instance v0, Landroid/content/ContextWrapper;

    .line 25
    sget-object v4, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v4}, Lcom/hdc/myimage/MyImageActivity;->getApplicationContext()Landroid/content/Context;

    move-result-object v4

    .line 24
    invoke-direct {v0, v4}, Landroid/content/ContextWrapper;-><init>(Landroid/content/Context;)V

    .line 26
    .local v0, cw:Landroid/content/ContextWrapper;
    const-string v4, "myuser"

    invoke-virtual {v0, v4, v3}, Landroid/content/ContextWrapper;->getDir(Ljava/lang/String;I)Ljava/io/File;

    move-result-object v1

    .line 27
    .local v1, directory:Ljava/io/File;
    new-instance v2, Ljava/io/File;

    invoke-direct {v2, v1, p0}, Ljava/io/File;-><init>(Ljava/io/File;Ljava/lang/String;)V

    .line 28
    .local v2, mypath:Ljava/io/File;
    invoke-virtual {v2}, Ljava/io/File;->exists()Z

    move-result v4

    if-nez v4, :cond_0

    .line 31
    :goto_0
    return v3

    :cond_0
    const/4 v3, 0x1

    goto :goto_0
.end method

.method public static loadUserAndPass(Ljava/lang/String;)Ljava/lang/String;
    .locals 11
    .parameter "name"

    .prologue
    .line 57
    const/4 v6, 0x0

    .line 59
    .local v6, fis:Ljava/io/FileInputStream;
    const-string v8, ""

    .line 61
    .local v8, userID:Ljava/lang/String;
    :try_start_0
    new-instance v0, Landroid/content/ContextWrapper;

    .line 62
    sget-object v9, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v9}, Lcom/hdc/myimage/MyImageActivity;->getApplicationContext()Landroid/content/Context;

    move-result-object v9

    .line 61
    invoke-direct {v0, v9}, Landroid/content/ContextWrapper;-><init>(Landroid/content/Context;)V

    .line 63
    .local v0, cw:Landroid/content/ContextWrapper;
    const-string v9, "myuser"

    const/4 v10, 0x0

    invoke-virtual {v0, v9, v10}, Landroid/content/ContextWrapper;->getDir(Ljava/lang/String;I)Ljava/io/File;

    move-result-object v1

    .line 64
    .local v1, directory:Ljava/io/File;
    new-instance v5, Ljava/io/File;

    invoke-direct {v5, v1, p0}, Ljava/io/File;-><init>(Ljava/io/File;Ljava/lang/String;)V

    .line 65
    .local v5, file:Ljava/io/File;
    invoke-virtual {v5}, Ljava/io/File;->exists()Z

    move-result v9

    if-eqz v9, :cond_0

    .line 66
    new-instance v7, Ljava/io/FileInputStream;

    invoke-direct {v7, v5}, Ljava/io/FileInputStream;-><init>(Ljava/io/File;)V
    :try_end_0
    .catch Ljava/io/FileNotFoundException; {:try_start_0 .. :try_end_0} :catch_0
    .catch Ljava/io/IOException; {:try_start_0 .. :try_end_0} :catch_1

    .line 67
    .end local v6           #fis:Ljava/io/FileInputStream;
    .local v7, fis:Ljava/io/FileInputStream;
    :try_start_1
    new-instance v2, Ljava/io/DataInputStream;

    invoke-direct {v2, v7}, Ljava/io/DataInputStream;-><init>(Ljava/io/InputStream;)V

    .line 68
    .local v2, dis:Ljava/io/DataInputStream;
    invoke-virtual {v2}, Ljava/io/DataInputStream;->readUTF()Ljava/lang/String;
    :try_end_1
    .catch Ljava/io/FileNotFoundException; {:try_start_1 .. :try_end_1} :catch_3
    .catch Ljava/io/IOException; {:try_start_1 .. :try_end_1} :catch_2

    move-result-object v8

    move-object v6, v7

    .line 76
    .end local v0           #cw:Landroid/content/ContextWrapper;
    .end local v1           #directory:Ljava/io/File;
    .end local v2           #dis:Ljava/io/DataInputStream;
    .end local v5           #file:Ljava/io/File;
    .end local v7           #fis:Ljava/io/FileInputStream;
    .restart local v6       #fis:Ljava/io/FileInputStream;
    :cond_0
    :goto_0
    return-object v8

    .line 70
    :catch_0
    move-exception v3

    .line 71
    .local v3, e:Ljava/io/FileNotFoundException;
    :goto_1
    invoke-virtual {v3}, Ljava/io/FileNotFoundException;->printStackTrace()V

    goto :goto_0

    .line 72
    .end local v3           #e:Ljava/io/FileNotFoundException;
    :catch_1
    move-exception v4

    .line 73
    .local v4, f1:Ljava/io/IOException;
    :goto_2
    invoke-virtual {v4}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_0

    .line 72
    .end local v4           #f1:Ljava/io/IOException;
    .end local v6           #fis:Ljava/io/FileInputStream;
    .restart local v0       #cw:Landroid/content/ContextWrapper;
    .restart local v1       #directory:Ljava/io/File;
    .restart local v5       #file:Ljava/io/File;
    .restart local v7       #fis:Ljava/io/FileInputStream;
    :catch_2
    move-exception v4

    move-object v6, v7

    .end local v7           #fis:Ljava/io/FileInputStream;
    .restart local v6       #fis:Ljava/io/FileInputStream;
    goto :goto_2

    .line 70
    .end local v6           #fis:Ljava/io/FileInputStream;
    .restart local v7       #fis:Ljava/io/FileInputStream;
    :catch_3
    move-exception v3

    move-object v6, v7

    .end local v7           #fis:Ljava/io/FileInputStream;
    .restart local v6       #fis:Ljava/io/FileInputStream;
    goto :goto_1
.end method

.method public static loadfileExternalStorage(I)Ljava/util/ArrayList;
    .locals 6
    .parameter "file"
    .annotation system Ldalvik/annotation/Signature;
        value = {
            "(I)",
            "Ljava/util/ArrayList",
            "<",
            "Ljava/lang/String;",
            ">;"
        }
    .end annotation

    .prologue
    .line 81
    new-instance v0, Ljava/util/ArrayList;

    invoke-direct {v0}, Ljava/util/ArrayList;-><init>()V

    .line 82
    .local v0, aa:Ljava/util/ArrayList;,"Ljava/util/ArrayList<Ljava/lang/String;>;"
    const-string v4, ""

    .line 83
    .local v4, str:Ljava/lang/String;
    sget-object v5, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v5}, Lcom/hdc/myimage/MyImageActivity;->getResources()Landroid/content/res/Resources;

    move-result-object v5

    .line 84
    invoke-virtual {v5, p0}, Landroid/content/res/Resources;->openRawResource(I)Ljava/io/InputStream;

    move-result-object v2

    .line 85
    .local v2, is:Ljava/io/InputStream;
    new-instance v3, Ljava/io/BufferedReader;

    new-instance v5, Ljava/io/InputStreamReader;

    invoke-direct {v5, v2}, Ljava/io/InputStreamReader;-><init>(Ljava/io/InputStream;)V

    invoke-direct {v3, v5}, Ljava/io/BufferedReader;-><init>(Ljava/io/Reader;)V

    .line 87
    .local v3, reader:Ljava/io/BufferedReader;
    if-eqz v2, :cond_0

    .line 88
    :goto_0
    :try_start_0
    invoke-virtual {v3}, Ljava/io/BufferedReader;->readLine()Ljava/lang/String;

    move-result-object v4

    if-nez v4, :cond_1

    .line 91
    invoke-virtual {v2}, Ljava/io/InputStream;->close()V

    .line 97
    :cond_0
    :goto_1
    return-object v0

    .line 89
    :cond_1
    invoke-virtual {v4}, Ljava/lang/String;->trim()Ljava/lang/String;

    move-result-object v5

    invoke-virtual {v5}, Ljava/lang/String;->toString()Ljava/lang/String;

    move-result-object v5

    invoke-virtual {v0, v5}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z
    :try_end_0
    .catch Ljava/io/IOException; {:try_start_0 .. :try_end_0} :catch_0

    goto :goto_0

    .line 93
    :catch_0
    move-exception v1

    .line 95
    .local v1, e:Ljava/io/IOException;
    invoke-virtual {v1}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_1
.end method

.method public static saveUserID(Ljava/lang/String;Ljava/lang/String;)V
    .locals 9
    .parameter "user"
    .parameter "mfile"

    .prologue
    .line 36
    const/4 v5, 0x0

    .line 39
    .local v5, fos:Ljava/io/FileOutputStream;
    :try_start_0
    new-instance v0, Landroid/content/ContextWrapper;

    .line 40
    sget-object v7, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v7}, Lcom/hdc/myimage/MyImageActivity;->getApplicationContext()Landroid/content/Context;

    move-result-object v7

    .line 39
    invoke-direct {v0, v7}, Landroid/content/ContextWrapper;-><init>(Landroid/content/Context;)V

    .line 41
    .local v0, cw:Landroid/content/ContextWrapper;
    const-string v7, "myuser"

    const/4 v8, 0x0

    invoke-virtual {v0, v7, v8}, Landroid/content/ContextWrapper;->getDir(Ljava/lang/String;I)Ljava/io/File;

    move-result-object v1

    .line 42
    .local v1, directory:Ljava/io/File;
    new-instance v4, Ljava/io/File;

    invoke-direct {v4, v1, p1}, Ljava/io/File;-><init>(Ljava/io/File;Ljava/lang/String;)V

    .line 43
    .local v4, file:Ljava/io/File;
    invoke-virtual {v4}, Ljava/io/File;->exists()Z

    move-result v7

    if-eqz v7, :cond_0

    .line 44
    invoke-virtual {v4}, Ljava/io/File;->delete()Z

    .line 46
    :cond_0
    invoke-virtual {v4}, Ljava/io/File;->createNewFile()Z

    .line 47
    new-instance v6, Ljava/io/FileOutputStream;

    invoke-direct {v6, v4}, Ljava/io/FileOutputStream;-><init>(Ljava/io/File;)V
    :try_end_0
    .catch Ljava/io/IOException; {:try_start_0 .. :try_end_0} :catch_0

    .line 48
    .end local v5           #fos:Ljava/io/FileOutputStream;
    .local v6, fos:Ljava/io/FileOutputStream;
    :try_start_1
    new-instance v2, Ljava/io/DataOutputStream;

    invoke-direct {v2, v6}, Ljava/io/DataOutputStream;-><init>(Ljava/io/OutputStream;)V

    .line 49
    .local v2, dos:Ljava/io/DataOutputStream;
    invoke-virtual {v2, p0}, Ljava/io/DataOutputStream;->writeUTF(Ljava/lang/String;)V
    :try_end_1
    .catch Ljava/io/IOException; {:try_start_1 .. :try_end_1} :catch_1

    move-object v5, v6

    .line 53
    .end local v0           #cw:Landroid/content/ContextWrapper;
    .end local v1           #directory:Ljava/io/File;
    .end local v2           #dos:Ljava/io/DataOutputStream;
    .end local v4           #file:Ljava/io/File;
    .end local v6           #fos:Ljava/io/FileOutputStream;
    .restart local v5       #fos:Ljava/io/FileOutputStream;
    :goto_0
    return-void

    .line 50
    :catch_0
    move-exception v3

    .line 51
    .local v3, e:Ljava/io/IOException;
    :goto_1
    invoke-virtual {v3}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_0

    .line 50
    .end local v3           #e:Ljava/io/IOException;
    .end local v5           #fos:Ljava/io/FileOutputStream;
    .restart local v0       #cw:Landroid/content/ContextWrapper;
    .restart local v1       #directory:Ljava/io/File;
    .restart local v4       #file:Ljava/io/File;
    .restart local v6       #fos:Ljava/io/FileOutputStream;
    :catch_1
    move-exception v3

    move-object v5, v6

    .end local v6           #fos:Ljava/io/FileOutputStream;
    .restart local v5       #fos:Ljava/io/FileOutputStream;
    goto :goto_1
.end method
