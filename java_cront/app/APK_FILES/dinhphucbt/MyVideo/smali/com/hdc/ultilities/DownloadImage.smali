.class public Lcom/hdc/ultilities/DownloadImage;
.super Ljava/lang/Object;
.source "DownloadImage.java"


# static fields
.field public static instance:Lcom/hdc/ultilities/DownloadImage;


# direct methods
.method static constructor <clinit>()V
    .locals 1

    .prologue
    .line 14
    new-instance v0, Lcom/hdc/ultilities/DownloadImage;

    invoke-direct {v0}, Lcom/hdc/ultilities/DownloadImage;-><init>()V

    sput-object v0, Lcom/hdc/ultilities/DownloadImage;->instance:Lcom/hdc/ultilities/DownloadImage;

    .line 13
    return-void
.end method

.method public constructor <init>()V
    .locals 0

    .prologue
    .line 15
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    .line 16
    return-void
.end method

.method private static OpenHttpConnection(Ljava/lang/String;)Ljava/io/InputStream;
    .locals 11
    .parameter "urlString"
    .annotation system Ldalvik/annotation/Throws;
        value = {
            Ljava/io/IOException;
        }
    .end annotation

    .prologue
    .line 35
    const/4 v5, 0x0

    .line 36
    .local v5, in:Ljava/io/InputStream;
    const/4 v6, -0x1

    .line 38
    .local v6, response:I
    const/4 v7, 0x0

    .line 41
    .local v7, url:Ljava/net/URL;
    :try_start_0
    new-instance v8, Ljava/net/URL;

    invoke-direct {v8, p0}, Ljava/net/URL;-><init>(Ljava/lang/String;)V
    :try_end_0
    .catch Ljava/net/MalformedURLException; {:try_start_0 .. :try_end_0} :catch_0

    .end local v7           #url:Ljava/net/URL;
    .local v8, url:Ljava/net/URL;
    move-object v7, v8

    .line 47
    .end local v8           #url:Ljava/net/URL;
    .restart local v7       #url:Ljava/net/URL;
    :goto_0
    invoke-virtual {v7}, Ljava/net/URL;->openConnection()Ljava/net/URLConnection;

    move-result-object v1

    .line 49
    .local v1, conn:Ljava/net/URLConnection;
    instance-of v9, v1, Ljava/net/HttpURLConnection;

    if-nez v9, :cond_0

    .line 50
    new-instance v9, Ljava/io/IOException;

    const-string v10, "Not an HTTP connection"

    invoke-direct {v9, v10}, Ljava/io/IOException;-><init>(Ljava/lang/String;)V

    throw v9

    .line 43
    .end local v1           #conn:Ljava/net/URLConnection;
    :catch_0
    move-exception v2

    .line 44
    .local v2, e:Ljava/net/MalformedURLException;
    invoke-virtual {v2}, Ljava/net/MalformedURLException;->printStackTrace()V

    goto :goto_0

    .line 53
    .end local v2           #e:Ljava/net/MalformedURLException;
    .restart local v1       #conn:Ljava/net/URLConnection;
    :cond_0
    :try_start_1
    move-object v0, v1

    check-cast v0, Ljava/net/HttpURLConnection;

    move-object v4, v0

    .line 57
    .local v4, httpConn:Ljava/net/HttpURLConnection;
    const/4 v9, 0x1

    invoke-virtual {v4, v9}, Ljava/net/HttpURLConnection;->setDoInput(Z)V

    .line 58
    invoke-virtual {v4}, Ljava/net/HttpURLConnection;->connect()V

    .line 60
    invoke-virtual {v4}, Ljava/net/HttpURLConnection;->getResponseCode()I

    move-result v6

    .line 61
    const/16 v9, 0xc8

    if-ne v6, v9, :cond_1

    .line 62
    invoke-virtual {v4}, Ljava/net/HttpURLConnection;->getInputStream()Ljava/io/InputStream;
    :try_end_1
    .catch Ljava/lang/Exception; {:try_start_1 .. :try_end_1} :catch_1

    move-result-object v5

    .line 69
    :cond_1
    return-object v5

    .line 65
    .end local v4           #httpConn:Ljava/net/HttpURLConnection;
    :catch_1
    move-exception v3

    .line 67
    .local v3, ex:Ljava/lang/Exception;
    new-instance v9, Ljava/io/IOException;

    const-string v10, "Error connecting"

    invoke-direct {v9, v10}, Ljava/io/IOException;-><init>(Ljava/lang/String;)V

    throw v9
.end method


# virtual methods
.method public getImage(Ljava/lang/String;)Landroid/graphics/Bitmap;
    .locals 3
    .parameter "URL"

    .prologue
    .line 19
    const/4 v0, 0x0

    .line 20
    .local v0, bitmap:Landroid/graphics/Bitmap;
    const/4 v2, 0x0

    .line 22
    .local v2, in:Ljava/io/InputStream;
    :try_start_0
    invoke-static {p1}, Lcom/hdc/ultilities/DownloadImage;->OpenHttpConnection(Ljava/lang/String;)Ljava/io/InputStream;

    move-result-object v2

    .line 23
    invoke-static {v2}, Landroid/graphics/BitmapFactory;->decodeStream(Ljava/io/InputStream;)Landroid/graphics/Bitmap;

    move-result-object v0

    .line 24
    invoke-virtual {v2}, Ljava/io/InputStream;->close()V
    :try_end_0
    .catch Ljava/io/IOException; {:try_start_0 .. :try_end_0} :catch_0

    .line 29
    :goto_0
    return-object v0

    .line 25
    :catch_0
    move-exception v1

    .line 27
    .local v1, e1:Ljava/io/IOException;
    invoke-virtual {v1}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_0
.end method
