.class public Lcom/hdc/ultilities/Image;
.super Ljava/lang/Object;
.source "Image.java"


# direct methods
.method public constructor <init>()V
    .locals 0

    .prologue
    .line 11
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method

.method public static BitmapResize(Landroid/graphics/Bitmap;FF)Landroid/graphics/Bitmap;
    .locals 10
    .parameter "bitmap"
    .parameter "newWidth"
    .parameter "newHeight"

    .prologue
    const/4 v1, 0x0

    .line 17
    invoke-virtual {p0}, Landroid/graphics/Bitmap;->getWidth()I

    move-result v3

    .line 18
    .local v3, width:I
    invoke-virtual {p0}, Landroid/graphics/Bitmap;->getHeight()I

    move-result v4

    .line 20
    .local v4, height:I
    int-to-float v0, v3

    div-float v9, p1, v0

    .line 21
    .local v9, scaleWidth:F
    int-to-float v0, v4

    div-float v8, p2, v0

    .line 24
    .local v8, scaleHeight:F
    new-instance v5, Landroid/graphics/Matrix;

    invoke-direct {v5}, Landroid/graphics/Matrix;-><init>()V

    .line 26
    .local v5, matrix:Landroid/graphics/Matrix;
    invoke-virtual {v5, v9, v8}, Landroid/graphics/Matrix;->postScale(FF)Z

    .line 30
    const/4 v6, 0x1

    move-object v0, p0

    move v2, v1

    .line 29
    invoke-static/range {v0 .. v6}, Landroid/graphics/Bitmap;->createBitmap(Landroid/graphics/Bitmap;IIIILandroid/graphics/Matrix;Z)Landroid/graphics/Bitmap;

    move-result-object v7

    .line 32
    .local v7, resizedBitmap:Landroid/graphics/Bitmap;
    return-object v7
.end method

.method public static createImage(Ljava/lang/String;I)Landroid/graphics/Bitmap;
    .locals 6
    .parameter "fileName"
    .parameter "flag"

    .prologue
    .line 37
    const/4 v2, 0x0

    .line 38
    .local v2, in:Ljava/io/InputStream;
    const/4 v0, 0x0

    .line 41
    .local v0, bitmap:Landroid/graphics/Bitmap;
    :try_start_0
    new-instance v3, Ljava/lang/StringBuilder;

    invoke-static {p0}, Ljava/lang/String;->valueOf(Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v4

    invoke-direct {v3, v4}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    const-string v4, ".png"

    invoke-virtual {v3, v4}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v3

    invoke-virtual {v3}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object p0

    .line 42
    sget-object v3, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    iget-object v3, v3, Lcom/hdc/myimage/MyImageActivity;->assets:Landroid/content/res/AssetManager;

    invoke-virtual {v3, p0}, Landroid/content/res/AssetManager;->open(Ljava/lang/String;)Ljava/io/InputStream;

    move-result-object v2

    .line 43
    invoke-static {v2}, Landroid/graphics/BitmapFactory;->decodeStream(Ljava/io/InputStream;)Landroid/graphics/Bitmap;

    move-result-object v0

    .line 44
    if-nez p1, :cond_0

    .line 45
    sget-object v3, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    iget v3, v3, Lcom/hdc/myimage/MyImageActivity;->width:I

    const/16 v4, 0xf0

    if-eq v3, v4, :cond_0

    .line 46
    sget-object v3, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    iget v3, v3, Lcom/hdc/myimage/MyImageActivity;->height:I

    const/16 v4, 0x140

    if-eq v3, v4, :cond_0

    .line 48
    sget-object v3, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    iget v3, v3, Lcom/hdc/myimage/MyImageActivity;->width:I

    int-to-float v3, v3

    .line 49
    sget-object v4, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    iget v4, v4, Lcom/hdc/myimage/MyImageActivity;->height:I

    int-to-float v4, v4

    .line 47
    invoke-static {v0, v3, v4}, Lcom/hdc/ultilities/Image;->BitmapResize(Landroid/graphics/Bitmap;FF)Landroid/graphics/Bitmap;
    :try_end_0
    .catchall {:try_start_0 .. :try_end_0} :catchall_0
    .catch Ljava/io/IOException; {:try_start_0 .. :try_end_0} :catch_0

    move-result-object v0

    .line 60
    :cond_0
    if-eqz v2, :cond_1

    .line 62
    :try_start_1
    invoke-virtual {v2}, Ljava/io/InputStream;->close()V
    :try_end_1
    .catch Ljava/io/IOException; {:try_start_1 .. :try_end_1} :catch_2

    .line 69
    :cond_1
    :goto_0
    return-object v0

    .line 56
    :catch_0
    move-exception v1

    .line 57
    .local v1, e:Ljava/io/IOException;
    :try_start_2
    new-instance v3, Ljava/lang/RuntimeException;

    new-instance v4, Ljava/lang/StringBuilder;

    const-string v5, "Couldn\'t load bitmap from asset \'"

    invoke-direct {v4, v5}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    .line 58
    invoke-virtual {v4, p0}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v4

    const-string v5, "\'"

    invoke-virtual {v4, v5}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v4

    invoke-virtual {v4}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v4

    .line 57
    invoke-direct {v3, v4}, Ljava/lang/RuntimeException;-><init>(Ljava/lang/String;)V

    throw v3
    :try_end_2
    .catchall {:try_start_2 .. :try_end_2} :catchall_0

    .line 59
    .end local v1           #e:Ljava/io/IOException;
    :catchall_0
    move-exception v3

    .line 60
    if-eqz v2, :cond_2

    .line 62
    :try_start_3
    invoke-virtual {v2}, Ljava/io/InputStream;->close()V
    :try_end_3
    .catch Ljava/io/IOException; {:try_start_3 .. :try_end_3} :catch_1

    .line 67
    :cond_2
    :goto_1
    throw v3

    .line 63
    :catch_1
    move-exception v1

    .line 64
    .restart local v1       #e:Ljava/io/IOException;
    invoke-virtual {v1}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_1

    .line 63
    .end local v1           #e:Ljava/io/IOException;
    :catch_2
    move-exception v1

    .line 64
    .restart local v1       #e:Ljava/io/IOException;
    invoke-virtual {v1}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_0
.end method
