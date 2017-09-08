.class public Lcom/hdc/ultilities/ConnectServer;
.super Ljava/lang/Object;
.source "ConnectServer.java"


# static fields
.field public static And:Ljava/lang/String; = null

.field public static final EMPTY:Ljava/lang/String; = "EMPTY"

.field public static Equals:Ljava/lang/String; = null

.field public static final GetPhotoList:Ljava/lang/String; = "GetPhotoList.php"

.field public static HOST:Ljava/lang/String; = null

.field public static Question:Ljava/lang/String; = null

.field public static final Register:Ljava/lang/String; = "Register.php"

.field public static SPACE:Ljava/lang/String; = null

.field public static final Version:Ljava/lang/String; = "Version.php"

.field public static catID:Ljava/lang/String; = null

.field static client:Lorg/apache/http/client/HttpClient; = null

.field static httppost:Lorg/apache/http/client/methods/HttpPost; = null

.field public static instance:Lcom/hdc/ultilities/ConnectServer; = null

.field public static m_UserID:Ljava/lang/String; = null

.field public static final midp:Ljava/lang/String; = "2.0"

.field static nameValuePair:Ljava/util/ArrayList; = null
    .annotation system Ldalvik/annotation/Signature;
        value = {
            "Ljava/util/ArrayList",
            "<",
            "Lorg/apache/http/NameValuePair;",
            ">;"
        }
    .end annotation
.end field

.field static p:Lorg/apache/http/params/HttpParams; = null

.field public static pageCurrent:I = 0x0

.field public static final type:Ljava/lang/String; = "photo"

.field public static final v:Ljava/lang/String; = "1.0"


# instance fields
.field public LINK_UPDATE:Ljava/lang/String;

.field public PROVIDER_ID:Ljava/lang/String;

.field public REF_CODE:Ljava/lang/String;

.field public m_Advertise:Lcom/hdc/data/Advertise;

.field public m_Data:Lcom/hdc/data/Data;

.field public m_ListItem:Ljava/util/ArrayList;
    .annotation system Ldalvik/annotation/Signature;
        value = {
            "Ljava/util/ArrayList",
            "<",
            "Lcom/hdc/data/Item;",
            ">;"
        }
    .end annotation
.end field

.field public m_Message:Lcom/hdc/data/Message;

.field public m_Promotion:Lcom/hdc/data/Promotion;

.field public m_Sms:Lcom/hdc/data/Sms;


# direct methods
.method static constructor <clinit>()V
    .locals 1

    .prologue
    .line 30
    new-instance v0, Lcom/hdc/ultilities/ConnectServer;

    invoke-direct {v0}, Lcom/hdc/ultilities/ConnectServer;-><init>()V

    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    .line 32
    const-string v0, "http://taoviec.com/api/"

    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->HOST:Ljava/lang/String;

    .line 41
    const-string v0, "?"

    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->Question:Ljava/lang/String;

    .line 42
    const-string v0, "&"

    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    .line 43
    const-string v0, "="

    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    .line 44
    const-string v0, "0"

    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->catID:Ljava/lang/String;

    .line 45
    const/4 v0, 0x1

    sput v0, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    .line 46
    const-string v0, ""

    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->m_UserID:Ljava/lang/String;

    .line 47
    const-string v0, " "

    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->SPACE:Ljava/lang/String;

    .line 29
    return-void
.end method

.method public constructor <init>()V
    .locals 1

    .prologue
    .line 68
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    .line 34
    const-string v0, "10e36710a919d7f43080695cf8587e9c"

    iput-object v0, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    .line 48
    const-string v0, "0"

    iput-object v0, p0, Lcom/hdc/ultilities/ConnectServer;->PROVIDER_ID:Ljava/lang/String;

    .line 49
    const-string v0, "http://thegioigame.mobi/"

    iput-object v0, p0, Lcom/hdc/ultilities/ConnectServer;->LINK_UPDATE:Ljava/lang/String;

    .line 64
    new-instance v0, Ljava/util/ArrayList;

    invoke-direct {v0}, Ljava/util/ArrayList;-><init>()V

    iput-object v0, p0, Lcom/hdc/ultilities/ConnectServer;->m_ListItem:Ljava/util/ArrayList;

    .line 70
    return-void
.end method

.method public static getAdvertise(Ljava/lang/String;)Lcom/hdc/data/Advertise;
    .locals 5
    .parameter "data"

    .prologue
    .line 261
    new-instance v3, Lcom/hdc/data/Advertise;

    invoke-direct {v3}, Lcom/hdc/data/Advertise;-><init>()V

    .line 264
    .local v3, m:Lcom/hdc/data/Advertise;
    :try_start_0
    new-instance v1, Lorg/json/JSONObject;

    invoke-direct {v1, p0}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 265
    .local v1, json:Lorg/json/JSONObject;
    const-string v4, "message"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Advertise;->setMessage(Ljava/lang/String;)V

    .line 266
    const-string v4, "img"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Advertise;->setImg(Ljava/lang/String;)V

    .line 267
    const-string v4, "time_out"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v4}, Ljava/lang/String;->trim()Ljava/lang/String;

    move-result-object v4

    invoke-static {v4}, Ljava/lang/Integer;->parseInt(Ljava/lang/String;)I

    move-result v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Advertise;->setTime_out(I)V

    .line 268
    new-instance v2, Lorg/json/JSONObject;

    const-string v4, "action"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-direct {v2, v4}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 269
    .end local v1           #json:Lorg/json/JSONObject;
    .local v2, json:Lorg/json/JSONObject;
    const-string v4, "type"

    invoke-virtual {v2, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Advertise;->setType(Ljava/lang/String;)V

    .line 270
    const-string v4, "url"

    invoke-virtual {v2, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Advertise;->setUrl(Ljava/lang/String;)V
    :try_end_0
    .catch Lorg/json/JSONException; {:try_start_0 .. :try_end_0} :catch_0

    .line 276
    .end local v2           #json:Lorg/json/JSONObject;
    :goto_0
    return-object v3

    .line 271
    :catch_0
    move-exception v0

    .line 273
    .local v0, e:Lorg/json/JSONException;
    invoke-virtual {v0}, Lorg/json/JSONException;->printStackTrace()V

    goto :goto_0
.end method

.method public static getData(Ljava/lang/String;)Lcom/hdc/data/Data;
    .locals 5
    .parameter "data"

    .prologue
    .line 298
    new-instance v3, Lcom/hdc/data/Data;

    invoke-direct {v3}, Lcom/hdc/data/Data;-><init>()V

    .line 300
    .local v3, p1:Lcom/hdc/data/Data;
    :try_start_0
    new-instance v1, Lorg/json/JSONObject;

    invoke-direct {v1, p0}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 301
    .local v1, json:Lorg/json/JSONObject;
    const-string v4, "type"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Data;->setType(Ljava/lang/String;)V

    .line 302
    const-string v4, "totalPage"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-static {v4}, Ljava/lang/Integer;->parseInt(Ljava/lang/String;)I

    move-result v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Data;->setTotalPage(I)V

    .line 303
    new-instance v2, Lorg/json/JSONObject;

    const-string v4, "action"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-direct {v2, v4}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 304
    .end local v1           #json:Lorg/json/JSONObject;
    .local v2, json:Lorg/json/JSONObject;
    const-string v4, "type"

    invoke-virtual {v2, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Data;->setTypeAction(Ljava/lang/String;)V

    .line 305
    const-string v4, "url"

    invoke-virtual {v2, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Data;->setUrl(Ljava/lang/String;)V
    :try_end_0
    .catch Lorg/json/JSONException; {:try_start_0 .. :try_end_0} :catch_0

    .line 310
    .end local v2           #json:Lorg/json/JSONObject;
    :goto_0
    return-object v3

    .line 306
    :catch_0
    move-exception v0

    .line 308
    .local v0, e:Lorg/json/JSONException;
    invoke-virtual {v0}, Lorg/json/JSONException;->printStackTrace()V

    goto :goto_0
.end method

.method public static getDataPromotion(Ljava/lang/String;)Lcom/hdc/data/Promotion;
    .locals 5
    .parameter "data"

    .prologue
    .line 244
    new-instance v3, Lcom/hdc/data/Promotion;

    invoke-direct {v3}, Lcom/hdc/data/Promotion;-><init>()V

    .line 246
    .local v3, p1:Lcom/hdc/data/Promotion;
    :try_start_0
    new-instance v1, Lorg/json/JSONObject;

    invoke-direct {v1, p0}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 247
    .local v1, json:Lorg/json/JSONObject;
    const-string v4, "id"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Promotion;->setId(Ljava/lang/String;)V

    .line 248
    const-string v4, "title"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Promotion;->setTitle(Ljava/lang/String;)V

    .line 249
    new-instance v2, Lorg/json/JSONObject;

    const-string v4, "action"

    invoke-virtual {v1, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-direct {v2, v4}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 250
    .end local v1           #json:Lorg/json/JSONObject;
    .local v2, json:Lorg/json/JSONObject;
    const-string v4, "type"

    invoke-virtual {v2, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Promotion;->setType(Ljava/lang/String;)V

    .line 251
    const-string v4, "url"

    invoke-virtual {v2, v4}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    invoke-virtual {v3, v4}, Lcom/hdc/data/Promotion;->setUrl(Ljava/lang/String;)V
    :try_end_0
    .catch Lorg/json/JSONException; {:try_start_0 .. :try_end_0} :catch_0

    .line 256
    .end local v2           #json:Lorg/json/JSONObject;
    :goto_0
    return-object v3

    .line 252
    :catch_0
    move-exception v0

    .line 254
    .local v0, e:Lorg/json/JSONException;
    invoke-virtual {v0}, Lorg/json/JSONException;->printStackTrace()V

    goto :goto_0
.end method

.method public static getListItem(Ljava/lang/String;)Ljava/util/ArrayList;
    .locals 10
    .parameter "data"
    .annotation system Ldalvik/annotation/Signature;
        value = {
            "(",
            "Ljava/lang/String;",
            ")",
            "Ljava/util/ArrayList",
            "<",
            "Lcom/hdc/data/Item;",
            ">;"
        }
    .end annotation

    .prologue
    .line 332
    new-instance v0, Ljava/util/ArrayList;

    invoke-direct {v0}, Ljava/util/ArrayList;-><init>()V

    .line 334
    .local v0, aa:Ljava/util/ArrayList;,"Ljava/util/ArrayList<Lcom/hdc/data/Item;>;"
    const/4 v6, 0x0

    .line 336
    .local v6, json:Lorg/json/JSONArray;
    :try_start_0
    new-instance v7, Lorg/json/JSONArray;

    invoke-direct {v7, p0}, Lorg/json/JSONArray;-><init>(Ljava/lang/String;)V
    :try_end_0
    .catch Lorg/json/JSONException; {:try_start_0 .. :try_end_0} :catch_0

    .end local v6           #json:Lorg/json/JSONArray;
    .local v7, json:Lorg/json/JSONArray;
    move-object v6, v7

    .line 341
    .end local v7           #json:Lorg/json/JSONArray;
    .restart local v6       #json:Lorg/json/JSONArray;
    :goto_0
    const/4 v2, 0x0

    .local v2, i:I
    :goto_1
    invoke-virtual {v6}, Lorg/json/JSONArray;->length()I

    move-result v8

    if-lt v2, v8, :cond_0

    .line 363
    return-object v0

    .line 337
    .end local v2           #i:I
    :catch_0
    move-exception v1

    .line 339
    .local v1, e:Lorg/json/JSONException;
    invoke-virtual {v1}, Lorg/json/JSONException;->printStackTrace()V

    goto :goto_0

    .line 342
    .end local v1           #e:Lorg/json/JSONException;
    .restart local v2       #i:I
    :cond_0
    new-instance v3, Lcom/hdc/data/Item;

    invoke-direct {v3}, Lcom/hdc/data/Item;-><init>()V

    .line 344
    .local v3, item:Lcom/hdc/data/Item;
    :try_start_1
    invoke-virtual {v6, v2}, Lorg/json/JSONArray;->getJSONObject(I)Lorg/json/JSONObject;

    move-result-object v4

    .line 345
    .local v4, j:Lorg/json/JSONObject;
    const-string v8, "id"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-virtual {v3, v8}, Lcom/hdc/data/Item;->setId(Ljava/lang/String;)V

    .line 346
    const-string v8, "title"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-virtual {v3, v8}, Lcom/hdc/data/Item;->setTitle(Ljava/lang/String;)V

    .line 347
    const-string v8, "info"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-virtual {v3, v8}, Lcom/hdc/data/Item;->setInfo(Ljava/lang/String;)V

    .line 348
    const-string v8, "summary"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-virtual {v3, v8}, Lcom/hdc/data/Item;->setSummary(Ljava/lang/String;)V

    .line 349
    new-instance v5, Lorg/json/JSONObject;

    const-string v8, "img"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-direct {v5, v8}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 350
    .end local v4           #j:Lorg/json/JSONObject;
    .local v5, j:Lorg/json/JSONObject;
    const-string v8, "w"

    invoke-virtual {v5, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-static {v8}, Ljava/lang/Integer;->parseInt(Ljava/lang/String;)I

    move-result v8

    invoke-virtual {v3, v8}, Lcom/hdc/data/Item;->setWidth(I)V

    .line 351
    const-string v8, "h"

    invoke-virtual {v5, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-static {v8}, Ljava/lang/Integer;->parseInt(Ljava/lang/String;)I

    move-result v8

    invoke-virtual {v3, v8}, Lcom/hdc/data/Item;->setHeight(I)V

    .line 352
    const-string v8, "src"

    invoke-virtual {v5, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-virtual {v3, v8}, Lcom/hdc/data/Item;->setSrc(Ljava/lang/String;)V

    .line 353
    sget-object v8, Lcom/hdc/ultilities/DownloadImage;->instance:Lcom/hdc/ultilities/DownloadImage;

    invoke-virtual {v3}, Lcom/hdc/data/Item;->getSrc()Ljava/lang/String;

    move-result-object v9

    invoke-virtual {v8, v9}, Lcom/hdc/ultilities/DownloadImage;->getImage(Ljava/lang/String;)Landroid/graphics/Bitmap;

    move-result-object v8

    invoke-virtual {v3, v8}, Lcom/hdc/data/Item;->setImg(Landroid/graphics/Bitmap;)V
    :try_end_1
    .catchall {:try_start_1 .. :try_end_1} :catchall_0
    .catch Lorg/json/JSONException; {:try_start_1 .. :try_end_1} :catch_1

    .line 359
    invoke-virtual {v0, v3}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 341
    .end local v5           #j:Lorg/json/JSONObject;
    :goto_2
    add-int/lit8 v2, v2, 0x1

    goto :goto_1

    .line 354
    :catch_1
    move-exception v1

    .line 356
    .restart local v1       #e:Lorg/json/JSONException;
    :try_start_2
    invoke-virtual {v1}, Lorg/json/JSONException;->printStackTrace()V
    :try_end_2
    .catchall {:try_start_2 .. :try_end_2} :catchall_0

    .line 359
    invoke-virtual {v0, v3}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    goto :goto_2

    .line 357
    .end local v1           #e:Lorg/json/JSONException;
    :catchall_0
    move-exception v8

    .line 359
    invoke-virtual {v0, v3}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 360
    throw v8
.end method

.method public static getMessage(Ljava/lang/String;)Lcom/hdc/data/Message;
    .locals 4
    .parameter "data"

    .prologue
    .line 281
    new-instance v2, Lcom/hdc/data/Message;

    invoke-direct {v2}, Lcom/hdc/data/Message;-><init>()V

    .line 284
    .local v2, m:Lcom/hdc/data/Message;
    :try_start_0
    new-instance v1, Lorg/json/JSONObject;

    invoke-direct {v1, p0}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 285
    .local v1, json:Lorg/json/JSONObject;
    const-string v3, "message"

    invoke-virtual {v1, v3}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v3

    invoke-virtual {v2, v3}, Lcom/hdc/data/Message;->setMessage(Ljava/lang/String;)V

    .line 286
    const-string v3, "code"

    invoke-virtual {v1, v3}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v3

    invoke-virtual {v2, v3}, Lcom/hdc/data/Message;->setCode(Ljava/lang/String;)V

    .line 287
    const-string v3, "date"

    invoke-virtual {v1, v3}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v3

    invoke-virtual {v2, v3}, Lcom/hdc/data/Message;->setDate(Ljava/lang/String;)V
    :try_end_0
    .catch Lorg/json/JSONException; {:try_start_0 .. :try_end_0} :catch_0

    .line 293
    .end local v1           #json:Lorg/json/JSONObject;
    :goto_0
    return-object v2

    .line 288
    :catch_0
    move-exception v0

    .line 290
    .local v0, e:Lorg/json/JSONException;
    invoke-virtual {v0}, Lorg/json/JSONException;->printStackTrace()V

    goto :goto_0
.end method

.method public static getSms(Ljava/lang/String;)Lcom/hdc/data/Sms;
    .locals 4
    .parameter "data"

    .prologue
    .line 315
    new-instance v2, Lcom/hdc/data/Sms;

    invoke-direct {v2}, Lcom/hdc/data/Sms;-><init>()V

    .line 318
    .local v2, m:Lcom/hdc/data/Sms;
    :try_start_0
    new-instance v1, Lorg/json/JSONObject;

    invoke-direct {v1, p0}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 319
    .local v1, json:Lorg/json/JSONObject;
    const-string v3, "message"

    invoke-virtual {v1, v3}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v3

    invoke-virtual {v2, v3}, Lcom/hdc/data/Sms;->setMessage(Ljava/lang/String;)V

    .line 320
    const-string v3, "syntax"

    invoke-virtual {v1, v3}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v3

    invoke-virtual {v2, v3}, Lcom/hdc/data/Sms;->setSyntax(Ljava/lang/String;)V

    .line 321
    const-string v3, "number"

    invoke-virtual {v1, v3}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v3

    invoke-virtual {v2, v3}, Lcom/hdc/data/Sms;->setNumber(Ljava/lang/String;)V
    :try_end_0
    .catch Lorg/json/JSONException; {:try_start_0 .. :try_end_0} :catch_0

    .line 327
    .end local v1           #json:Lorg/json/JSONObject;
    :goto_0
    return-object v2

    .line 322
    :catch_0
    move-exception v0

    .line 324
    .local v0, e:Lorg/json/JSONException;
    invoke-virtual {v0}, Lorg/json/JSONException;->printStackTrace()V

    goto :goto_0
.end method


# virtual methods
.method public getListImage(Ljava/lang/String;)V
    .locals 12
    .parameter "userID"

    .prologue
    .line 179
    const-string v1, ""

    .line 182
    .local v1, data:Ljava/lang/String;
    new-instance v8, Lorg/apache/http/params/BasicHttpParams;

    invoke-direct {v8}, Lorg/apache/http/params/BasicHttpParams;-><init>()V

    sput-object v8, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    .line 183
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v9, "catid"

    iget-object v10, p0, Lcom/hdc/ultilities/ConnectServer;->PROVIDER_ID:Ljava/lang/String;

    invoke-interface {v8, v9, v10}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 184
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v9, "p"

    sget v10, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    invoke-static {v10}, Ljava/lang/Integer;->toString(I)Ljava/lang/String;

    move-result-object v10

    invoke-interface {v8, v9, v10}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 185
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v9, "app"

    invoke-interface {v8, v9, p1}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 186
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v9, "refCode"

    iget-object v10, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-interface {v8, v9, v10}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 188
    new-instance v8, Lorg/apache/http/impl/client/DefaultHttpClient;

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    invoke-direct {v8, v9}, Lorg/apache/http/impl/client/DefaultHttpClient;-><init>(Lorg/apache/http/params/HttpParams;)V

    sput-object v8, Lcom/hdc/ultilities/ConnectServer;->client:Lorg/apache/http/client/HttpClient;

    .line 190
    new-instance v8, Ljava/util/ArrayList;

    invoke-direct {v8}, Ljava/util/ArrayList;-><init>()V

    sput-object v8, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    .line 191
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v9, Lorg/apache/http/message/BasicNameValuePair;

    const-string v10, "catid"

    iget-object v11, p0, Lcom/hdc/ultilities/ConnectServer;->PROVIDER_ID:Ljava/lang/String;

    invoke-direct {v9, v10, v11}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v8, v9}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 192
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v9, Lorg/apache/http/message/BasicNameValuePair;

    const-string v10, "p"

    .line 193
    sget v11, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    invoke-static {v11}, Ljava/lang/Integer;->toString(I)Ljava/lang/String;

    move-result-object v11

    invoke-direct {v9, v10, v11}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    .line 192
    invoke-virtual {v8, v9}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 194
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v9, Lorg/apache/http/message/BasicNameValuePair;

    const-string v10, "app"

    invoke-direct {v9, v10, p1}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v8, v9}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 195
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v9, Lorg/apache/http/message/BasicNameValuePair;

    const-string v10, "refCode"

    iget-object v11, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-direct {v9, v10, v11}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v8, v9}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 197
    new-instance v8, Ljava/lang/StringBuilder;

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->HOST:Ljava/lang/String;

    invoke-static {v9}, Ljava/lang/String;->valueOf(Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v9

    invoke-direct {v8, v9}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    const-string v9, "GetPhotoList.php"

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->Question:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    const-string v9, "catid"

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    .line 198
    iget-object v9, p0, Lcom/hdc/ultilities/ConnectServer;->PROVIDER_ID:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    const-string v9, "p"

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    .line 199
    sget v9, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    invoke-static {v9}, Ljava/lang/Integer;->toString(I)Ljava/lang/String;

    move-result-object v9

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    const-string v9, "app"

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    invoke-virtual {v8, p1}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    .line 200
    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    const-string v9, "refCode"

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    iget-object v9, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-virtual {v8, v9}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v8

    .line 197
    invoke-virtual {v8}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v7

    .line 202
    .local v7, url:Ljava/lang/String;
    new-instance v8, Lorg/apache/http/client/methods/HttpPost;

    invoke-direct {v8, v7}, Lorg/apache/http/client/methods/HttpPost;-><init>(Ljava/lang/String;)V

    sput-object v8, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    .line 204
    :try_start_0
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    new-instance v9, Lorg/apache/http/client/entity/UrlEncodedFormEntity;

    sget-object v10, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    invoke-direct {v9, v10}, Lorg/apache/http/client/entity/UrlEncodedFormEntity;-><init>(Ljava/util/List;)V

    invoke-virtual {v8, v9}, Lorg/apache/http/client/methods/HttpPost;->setEntity(Lorg/apache/http/HttpEntity;)V
    :try_end_0
    .catch Ljava/io/UnsupportedEncodingException; {:try_start_0 .. :try_end_0} :catch_0

    .line 209
    :goto_0
    new-instance v6, Lorg/apache/http/impl/client/BasicResponseHandler;

    invoke-direct {v6}, Lorg/apache/http/impl/client/BasicResponseHandler;-><init>()V

    .line 211
    .local v6, responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    :try_start_1
    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->client:Lorg/apache/http/client/HttpClient;

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    invoke-interface {v8, v9, v6}, Lorg/apache/http/client/HttpClient;->execute(Lorg/apache/http/client/methods/HttpUriRequest;Lorg/apache/http/client/ResponseHandler;)Ljava/lang/Object;

    move-result-object v8

    move-object v0, v8

    check-cast v0, Ljava/lang/String;

    move-object v1, v0
    :try_end_1
    .catch Lorg/apache/http/client/ClientProtocolException; {:try_start_1 .. :try_end_1} :catch_1
    .catch Ljava/io/IOException; {:try_start_1 .. :try_end_1} :catch_2

    .line 222
    :goto_1
    :try_start_2
    new-instance v4, Lorg/json/JSONObject;

    invoke-direct {v4, v1}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V
    :try_end_2
    .catch Lorg/json/JSONException; {:try_start_2 .. :try_end_2} :catch_3

    .line 224
    .local v4, j:Lorg/json/JSONObject;
    :try_start_3
    const-string v8, "promotion"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-static {v8}, Lcom/hdc/ultilities/ConnectServer;->getDataPromotion(Ljava/lang/String;)Lcom/hdc/data/Promotion;

    move-result-object v8

    iput-object v8, p0, Lcom/hdc/ultilities/ConnectServer;->m_Promotion:Lcom/hdc/data/Promotion;

    .line 225
    const-string v8, "ads"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-static {v8}, Lcom/hdc/ultilities/ConnectServer;->getAdvertise(Ljava/lang/String;)Lcom/hdc/data/Advertise;

    move-result-object v8

    iput-object v8, p0, Lcom/hdc/ultilities/ConnectServer;->m_Advertise:Lcom/hdc/data/Advertise;
    :try_end_3
    .catch Lorg/json/JSONException; {:try_start_3 .. :try_end_3} :catch_4

    .line 230
    :goto_2
    :try_start_4
    const-string v8, "status"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-static {v8}, Lcom/hdc/ultilities/ConnectServer;->getMessage(Ljava/lang/String;)Lcom/hdc/data/Message;

    move-result-object v8

    iput-object v8, p0, Lcom/hdc/ultilities/ConnectServer;->m_Message:Lcom/hdc/data/Message;

    .line 231
    const-string v8, "data"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-static {v8}, Lcom/hdc/ultilities/ConnectServer;->getData(Ljava/lang/String;)Lcom/hdc/data/Data;

    move-result-object v8

    iput-object v8, p0, Lcom/hdc/ultilities/ConnectServer;->m_Data:Lcom/hdc/data/Data;

    .line 233
    new-instance v5, Lorg/json/JSONObject;

    const-string v8, "data"

    invoke-virtual {v4, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-direct {v5, v8}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 234
    .end local v4           #j:Lorg/json/JSONObject;
    .local v5, j:Lorg/json/JSONObject;
    const-string v8, "item"

    invoke-virtual {v5, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-static {v8}, Lcom/hdc/ultilities/ConnectServer;->getListItem(Ljava/lang/String;)Ljava/util/ArrayList;

    move-result-object v8

    iput-object v8, p0, Lcom/hdc/ultilities/ConnectServer;->m_ListItem:Ljava/util/ArrayList;

    .line 235
    const-string v8, "sms"

    invoke-virtual {v5, v8}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v8

    invoke-static {v8}, Lcom/hdc/ultilities/ConnectServer;->getSms(Ljava/lang/String;)Lcom/hdc/data/Sms;

    move-result-object v8

    iput-object v8, p0, Lcom/hdc/ultilities/ConnectServer;->m_Sms:Lcom/hdc/data/Sms;
    :try_end_4
    .catch Lorg/json/JSONException; {:try_start_4 .. :try_end_4} :catch_3

    .line 240
    .end local v5           #j:Lorg/json/JSONObject;
    :goto_3
    return-void

    .line 205
    .end local v6           #responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    :catch_0
    move-exception v2

    .line 207
    .local v2, e:Ljava/io/UnsupportedEncodingException;
    invoke-virtual {v2}, Ljava/io/UnsupportedEncodingException;->printStackTrace()V

    goto :goto_0

    .line 212
    .end local v2           #e:Ljava/io/UnsupportedEncodingException;
    .restart local v6       #responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    :catch_1
    move-exception v2

    .line 214
    .local v2, e:Lorg/apache/http/client/ClientProtocolException;
    invoke-virtual {v2}, Lorg/apache/http/client/ClientProtocolException;->printStackTrace()V

    goto :goto_1

    .line 215
    .end local v2           #e:Lorg/apache/http/client/ClientProtocolException;
    :catch_2
    move-exception v2

    .line 217
    .local v2, e:Ljava/io/IOException;
    invoke-virtual {v2}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_1

    .line 236
    .end local v2           #e:Ljava/io/IOException;
    :catch_3
    move-exception v3

    .line 238
    .local v3, e1:Lorg/json/JSONException;
    invoke-virtual {v3}, Lorg/json/JSONException;->printStackTrace()V

    goto :goto_3

    .line 226
    .end local v3           #e1:Lorg/json/JSONException;
    .restart local v4       #j:Lorg/json/JSONObject;
    :catch_4
    move-exception v8

    goto :goto_2
.end method

.method public getUserID(II)Ljava/lang/String;
    .locals 11
    .parameter "w"
    .parameter "h"

    .prologue
    .line 74
    const-string v5, ""

    .line 77
    .local v5, userID:Ljava/lang/String;
    new-instance v6, Lorg/apache/http/params/BasicHttpParams;

    invoke-direct {v6}, Lorg/apache/http/params/BasicHttpParams;-><init>()V

    sput-object v6, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    .line 78
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v7, "brand"

    const-string v8, "EMPTY"

    invoke-interface {v6, v7, v8}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 79
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v7, "model"

    const-string v8, "EMPTY"

    invoke-interface {v6, v7, v8}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 80
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v7, "w"

    new-instance v8, Ljava/lang/StringBuilder;

    invoke-static {p1}, Ljava/lang/String;->valueOf(I)Ljava/lang/String;

    move-result-object v9

    invoke-direct {v8, v9}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    invoke-virtual {v8}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v8

    invoke-interface {v6, v7, v8}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 81
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v7, "h"

    new-instance v8, Ljava/lang/StringBuilder;

    invoke-static {p2}, Ljava/lang/String;->valueOf(I)Ljava/lang/String;

    move-result-object v9

    invoke-direct {v8, v9}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    invoke-virtual {v8}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v8

    invoke-interface {v6, v7, v8}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 82
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v7, "midp"

    const-string v8, "2.0"

    invoke-interface {v6, v7, v8}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 83
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v7, "v"

    const-string v8, "1.0"

    invoke-interface {v6, v7, v8}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 84
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v7, "refCode"

    iget-object v8, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-interface {v6, v7, v8}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 86
    new-instance v6, Lorg/apache/http/impl/client/DefaultHttpClient;

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    invoke-direct {v6, v7}, Lorg/apache/http/impl/client/DefaultHttpClient;-><init>(Lorg/apache/http/params/HttpParams;)V

    sput-object v6, Lcom/hdc/ultilities/ConnectServer;->client:Lorg/apache/http/client/HttpClient;

    .line 88
    new-instance v6, Ljava/util/ArrayList;

    invoke-direct {v6}, Ljava/util/ArrayList;-><init>()V

    sput-object v6, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    .line 89
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v7, Lorg/apache/http/message/BasicNameValuePair;

    const-string v8, "brand"

    const-string v9, "EMPTY"

    invoke-direct {v7, v8, v9}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v6, v7}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 90
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v7, Lorg/apache/http/message/BasicNameValuePair;

    const-string v8, "model"

    const-string v9, "EMPTY"

    invoke-direct {v7, v8, v9}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v6, v7}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 91
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v7, Lorg/apache/http/message/BasicNameValuePair;

    const-string v8, "w"

    new-instance v9, Ljava/lang/StringBuilder;

    invoke-static {p1}, Ljava/lang/String;->valueOf(I)Ljava/lang/String;

    move-result-object v10

    invoke-direct {v9, v10}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    invoke-virtual {v9}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v9

    invoke-direct {v7, v8, v9}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v6, v7}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 92
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v7, Lorg/apache/http/message/BasicNameValuePair;

    const-string v8, "h"

    new-instance v9, Ljava/lang/StringBuilder;

    invoke-static {p2}, Ljava/lang/String;->valueOf(I)Ljava/lang/String;

    move-result-object v10

    invoke-direct {v9, v10}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    invoke-virtual {v9}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v9

    invoke-direct {v7, v8, v9}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v6, v7}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 93
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v7, Lorg/apache/http/message/BasicNameValuePair;

    const-string v8, "midp"

    const-string v9, "2.0"

    invoke-direct {v7, v8, v9}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v6, v7}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 94
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v7, Lorg/apache/http/message/BasicNameValuePair;

    const-string v8, "v"

    const-string v9, "1.0"

    invoke-direct {v7, v8, v9}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v6, v7}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 95
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v7, Lorg/apache/http/message/BasicNameValuePair;

    const-string v8, "refCode"

    iget-object v9, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-direct {v7, v8, v9}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v6, v7}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 97
    new-instance v6, Ljava/lang/StringBuilder;

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->HOST:Ljava/lang/String;

    invoke-static {v7}, Ljava/lang/String;->valueOf(Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v7

    invoke-direct {v6, v7}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    const-string v7, "Register.php"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->Question:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "brand"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "EMPTY"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    .line 98
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "model"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "EMPTY"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "w"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    invoke-virtual {v6, p1}, Ljava/lang/StringBuilder;->append(I)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    .line 99
    const-string v7, "h"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    invoke-virtual {v6, p2}, Ljava/lang/StringBuilder;->append(I)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "midp"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "2.0"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "v"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    .line 100
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "1.0"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    const-string v7, "refCode"

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    iget-object v7, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-virtual {v6, v7}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v6

    .line 97
    invoke-virtual {v6}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v4

    .line 102
    .local v4, url:Ljava/lang/String;
    new-instance v6, Lorg/apache/http/client/methods/HttpPost;

    invoke-direct {v6, v4}, Lorg/apache/http/client/methods/HttpPost;-><init>(Ljava/lang/String;)V

    sput-object v6, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    .line 104
    :try_start_0
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    new-instance v7, Lorg/apache/http/client/entity/UrlEncodedFormEntity;

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    invoke-direct {v7, v8}, Lorg/apache/http/client/entity/UrlEncodedFormEntity;-><init>(Ljava/util/List;)V

    invoke-virtual {v6, v7}, Lorg/apache/http/client/methods/HttpPost;->setEntity(Lorg/apache/http/HttpEntity;)V
    :try_end_0
    .catch Ljava/io/UnsupportedEncodingException; {:try_start_0 .. :try_end_0} :catch_0

    .line 109
    :goto_0
    new-instance v2, Lorg/apache/http/impl/client/BasicResponseHandler;

    invoke-direct {v2}, Lorg/apache/http/impl/client/BasicResponseHandler;-><init>()V

    .line 111
    .local v2, responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    :try_start_1
    sget-object v6, Lcom/hdc/ultilities/ConnectServer;->client:Lorg/apache/http/client/HttpClient;

    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    invoke-interface {v6, v7, v2}, Lorg/apache/http/client/HttpClient;->execute(Lorg/apache/http/client/methods/HttpUriRequest;Lorg/apache/http/client/ResponseHandler;)Ljava/lang/Object;

    move-result-object v6

    move-object v0, v6

    check-cast v0, Ljava/lang/String;

    move-object v5, v0
    :try_end_1
    .catch Lorg/apache/http/client/ClientProtocolException; {:try_start_1 .. :try_end_1} :catch_1
    .catch Ljava/io/IOException; {:try_start_1 .. :try_end_1} :catch_2

    .line 121
    :goto_1
    const-string v6, "#"

    invoke-virtual {v5, v6}, Ljava/lang/String;->split(Ljava/lang/String;)[Ljava/lang/String;

    move-result-object v3

    .line 123
    .local v3, s:[Ljava/lang/String;
    const/4 v6, 0x1

    aget-object v6, v3, v6

    invoke-virtual {v6}, Ljava/lang/String;->toString()Ljava/lang/String;

    move-result-object v6

    return-object v6

    .line 105
    .end local v2           #responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    .end local v3           #s:[Ljava/lang/String;
    :catch_0
    move-exception v1

    .line 107
    .local v1, e:Ljava/io/UnsupportedEncodingException;
    invoke-virtual {v1}, Ljava/io/UnsupportedEncodingException;->printStackTrace()V

    goto :goto_0

    .line 112
    .end local v1           #e:Ljava/io/UnsupportedEncodingException;
    .restart local v2       #responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    :catch_1
    move-exception v1

    .line 114
    .local v1, e:Lorg/apache/http/client/ClientProtocolException;
    invoke-virtual {v1}, Lorg/apache/http/client/ClientProtocolException;->printStackTrace()V

    goto :goto_1

    .line 115
    .end local v1           #e:Lorg/apache/http/client/ClientProtocolException;
    :catch_2
    move-exception v1

    .line 117
    .local v1, e:Ljava/io/IOException;
    invoke-virtual {v1}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_1
.end method

.method public getVersion()Ljava/lang/String;
    .locals 11

    .prologue
    .line 128
    const-string v4, ""

    .line 131
    .local v4, m_version:Ljava/lang/String;
    new-instance v7, Lorg/apache/http/params/BasicHttpParams;

    invoke-direct {v7}, Lorg/apache/http/params/BasicHttpParams;-><init>()V

    sput-object v7, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    .line 132
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v8, "type"

    const-string v9, "photo"

    invoke-interface {v7, v8, v9}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 133
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v8, "v"

    const-string v9, "1.0"

    invoke-interface {v7, v8, v9}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 134
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    const-string v8, "refCode"

    iget-object v9, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-interface {v7, v8, v9}, Lorg/apache/http/params/HttpParams;->setParameter(Ljava/lang/String;Ljava/lang/Object;)Lorg/apache/http/params/HttpParams;

    .line 136
    new-instance v7, Lorg/apache/http/impl/client/DefaultHttpClient;

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->p:Lorg/apache/http/params/HttpParams;

    invoke-direct {v7, v8}, Lorg/apache/http/impl/client/DefaultHttpClient;-><init>(Lorg/apache/http/params/HttpParams;)V

    sput-object v7, Lcom/hdc/ultilities/ConnectServer;->client:Lorg/apache/http/client/HttpClient;

    .line 138
    new-instance v7, Ljava/util/ArrayList;

    invoke-direct {v7}, Ljava/util/ArrayList;-><init>()V

    sput-object v7, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    .line 139
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v8, Lorg/apache/http/message/BasicNameValuePair;

    const-string v9, "type"

    const-string v10, "photo"

    invoke-direct {v8, v9, v10}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v7, v8}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 140
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v8, Lorg/apache/http/message/BasicNameValuePair;

    const-string v9, "v"

    const-string v10, "1.0"

    invoke-direct {v8, v9, v10}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v7, v8}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 141
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    new-instance v8, Lorg/apache/http/message/BasicNameValuePair;

    const-string v9, "refCode"

    iget-object v10, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-direct {v8, v9, v10}, Lorg/apache/http/message/BasicNameValuePair;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-virtual {v7, v8}, Ljava/util/ArrayList;->add(Ljava/lang/Object;)Z

    .line 143
    new-instance v7, Ljava/lang/StringBuilder;

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->HOST:Ljava/lang/String;

    invoke-static {v8}, Ljava/lang/String;->valueOf(Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v8

    invoke-direct {v7, v8}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    const-string v8, "Version.php"

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->Question:Ljava/lang/String;

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    const-string v8, "type"

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    const-string v8, "photo"

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    .line 144
    const-string v8, "v"

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    const-string v8, "1.0"

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->And:Ljava/lang/String;

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    const-string v8, "refCode"

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->Equals:Ljava/lang/String;

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    iget-object v8, p0, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-virtual {v7, v8}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v7

    .line 143
    invoke-virtual {v7}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v6

    .line 146
    .local v6, url:Ljava/lang/String;
    new-instance v7, Lorg/apache/http/client/methods/HttpPost;

    invoke-direct {v7, v6}, Lorg/apache/http/client/methods/HttpPost;-><init>(Ljava/lang/String;)V

    sput-object v7, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    .line 148
    :try_start_0
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    new-instance v8, Lorg/apache/http/client/entity/UrlEncodedFormEntity;

    sget-object v9, Lcom/hdc/ultilities/ConnectServer;->nameValuePair:Ljava/util/ArrayList;

    invoke-direct {v8, v9}, Lorg/apache/http/client/entity/UrlEncodedFormEntity;-><init>(Ljava/util/List;)V

    invoke-virtual {v7, v8}, Lorg/apache/http/client/methods/HttpPost;->setEntity(Lorg/apache/http/HttpEntity;)V
    :try_end_0
    .catch Ljava/io/UnsupportedEncodingException; {:try_start_0 .. :try_end_0} :catch_0

    .line 153
    :goto_0
    new-instance v5, Lorg/apache/http/impl/client/BasicResponseHandler;

    invoke-direct {v5}, Lorg/apache/http/impl/client/BasicResponseHandler;-><init>()V

    .line 155
    .local v5, responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    :try_start_1
    sget-object v7, Lcom/hdc/ultilities/ConnectServer;->client:Lorg/apache/http/client/HttpClient;

    sget-object v8, Lcom/hdc/ultilities/ConnectServer;->httppost:Lorg/apache/http/client/methods/HttpPost;

    invoke-interface {v7, v8, v5}, Lorg/apache/http/client/HttpClient;->execute(Lorg/apache/http/client/methods/HttpUriRequest;Lorg/apache/http/client/ResponseHandler;)Ljava/lang/Object;

    move-result-object v7

    move-object v0, v7

    check-cast v0, Ljava/lang/String;

    move-object v4, v0
    :try_end_1
    .catch Lorg/apache/http/client/ClientProtocolException; {:try_start_1 .. :try_end_1} :catch_1
    .catch Ljava/io/IOException; {:try_start_1 .. :try_end_1} :catch_2

    .line 166
    :goto_1
    :try_start_2
    new-instance v3, Lorg/json/JSONObject;

    invoke-direct {v3, v4}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 167
    .local v3, j:Lorg/json/JSONObject;
    const-string v7, "status"

    invoke-virtual {v3, v7}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v4

    .line 168
    new-instance v3, Lorg/json/JSONObject;

    .end local v3           #j:Lorg/json/JSONObject;
    invoke-direct {v3, v4}, Lorg/json/JSONObject;-><init>(Ljava/lang/String;)V

    .line 169
    .restart local v3       #j:Lorg/json/JSONObject;
    const-string v7, "message"

    invoke-virtual {v3, v7}, Lorg/json/JSONObject;->getString(Ljava/lang/String;)Ljava/lang/String;
    :try_end_2
    .catch Lorg/json/JSONException; {:try_start_2 .. :try_end_2} :catch_3

    move-result-object v4

    .line 174
    .end local v3           #j:Lorg/json/JSONObject;
    :goto_2
    return-object v4

    .line 149
    .end local v5           #responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    :catch_0
    move-exception v1

    .line 151
    .local v1, e:Ljava/io/UnsupportedEncodingException;
    invoke-virtual {v1}, Ljava/io/UnsupportedEncodingException;->printStackTrace()V

    goto :goto_0

    .line 156
    .end local v1           #e:Ljava/io/UnsupportedEncodingException;
    .restart local v5       #responseHandler:Lorg/apache/http/client/ResponseHandler;,"Lorg/apache/http/client/ResponseHandler<Ljava/lang/String;>;"
    :catch_1
    move-exception v1

    .line 158
    .local v1, e:Lorg/apache/http/client/ClientProtocolException;
    invoke-virtual {v1}, Lorg/apache/http/client/ClientProtocolException;->printStackTrace()V

    goto :goto_1

    .line 159
    .end local v1           #e:Lorg/apache/http/client/ClientProtocolException;
    :catch_2
    move-exception v1

    .line 161
    .local v1, e:Ljava/io/IOException;
    invoke-virtual {v1}, Ljava/io/IOException;->printStackTrace()V

    goto :goto_1

    .line 170
    .end local v1           #e:Ljava/io/IOException;
    :catch_3
    move-exception v2

    .line 172
    .local v2, e1:Lorg/json/JSONException;
    invoke-virtual {v2}, Lorg/json/JSONException;->printStackTrace()V

    goto :goto_2
.end method
