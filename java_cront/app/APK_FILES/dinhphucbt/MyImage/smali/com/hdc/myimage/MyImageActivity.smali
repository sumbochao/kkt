.class public Lcom/hdc/myimage/MyImageActivity;
.super Landroid/app/Activity;
.source "MyImageActivity.java"


# static fields
.field public static instance:Lcom/hdc/myimage/MyImageActivity;


# instance fields
.field public alert:Landroid/app/AlertDialog;

.field public assets:Landroid/content/res/AssetManager;

.field dialog:Landroid/app/ProgressDialog;

.field public fileName:Ljava/lang/String;

.field public flagVersion:I

.field public height:I

.field public isConnect:Z

.field render:Lcom/hdc/view/AndroidFastRenderView;

.field public width:I


# direct methods
.method public constructor <init>()V
    .locals 1

    .prologue
    .line 25
    invoke-direct {p0}, Landroid/app/Activity;-><init>()V

    .line 33
    const-string v0, "userID.txt"

    iput-object v0, p0, Lcom/hdc/myimage/MyImageActivity;->fileName:Ljava/lang/String;

    .line 37
    const/4 v0, 0x0

    iput v0, p0, Lcom/hdc/myimage/MyImageActivity;->flagVersion:I

    .line 38
    const/4 v0, 0x1

    iput-boolean v0, p0, Lcom/hdc/myimage/MyImageActivity;->isConnect:Z

    .line 25
    return-void
.end method


# virtual methods
.method public checkUserID()V
    .locals 4

    .prologue
    .line 134
    iget-object v1, p0, Lcom/hdc/myimage/MyImageActivity;->fileName:Ljava/lang/String;

    invoke-static {v1}, Lcom/hdc/ultilities/FileManager;->fileIsExits(Ljava/lang/String;)Z

    move-result v1

    if-nez v1, :cond_0

    .line 136
    sget-object v1, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget v2, p0, Lcom/hdc/myimage/MyImageActivity;->width:I

    iget v3, p0, Lcom/hdc/myimage/MyImageActivity;->height:I

    invoke-virtual {v1, v2, v3}, Lcom/hdc/ultilities/ConnectServer;->getUserID(II)Ljava/lang/String;

    move-result-object v0

    .line 138
    .local v0, userID:Ljava/lang/String;
    iget-object v1, p0, Lcom/hdc/myimage/MyImageActivity;->fileName:Ljava/lang/String;

    invoke-static {v0, v1}, Lcom/hdc/ultilities/FileManager;->saveUserID(Ljava/lang/String;Ljava/lang/String;)V

    .line 139
    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->m_UserID:Ljava/lang/String;

    .line 141
    sget-object v1, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    invoke-virtual {v1, v0}, Lcom/hdc/ultilities/ConnectServer;->getListImage(Ljava/lang/String;)V

    .line 152
    :goto_0
    return-void

    .line 143
    .end local v0           #userID:Ljava/lang/String;
    :cond_0
    sget-object v1, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    invoke-virtual {v1}, Lcom/hdc/ultilities/ConnectServer;->getVersion()Ljava/lang/String;

    move-result-object v1

    const-string v2, ""

    invoke-virtual {v1, v2}, Ljava/lang/String;->equals(Ljava/lang/Object;)Z

    move-result v1

    if-nez v1, :cond_1

    .line 144
    const/4 v1, 0x1

    iput v1, p0, Lcom/hdc/myimage/MyImageActivity;->flagVersion:I

    .line 147
    :cond_1
    iget-object v1, p0, Lcom/hdc/myimage/MyImageActivity;->fileName:Ljava/lang/String;

    invoke-static {v1}, Lcom/hdc/ultilities/FileManager;->loadUserAndPass(Ljava/lang/String;)Ljava/lang/String;

    move-result-object v0

    .line 148
    .restart local v0       #userID:Ljava/lang/String;
    sput-object v0, Lcom/hdc/ultilities/ConnectServer;->m_UserID:Ljava/lang/String;

    .line 150
    sget-object v1, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    invoke-virtual {v1, v0}, Lcom/hdc/ultilities/ConnectServer;->getListImage(Ljava/lang/String;)V

    goto :goto_0
.end method

.method public onCreate(Landroid/os/Bundle;)V
    .locals 8
    .parameter "savedInstanceState"

    .prologue
    .line 44
    :try_start_0
    invoke-super {p0, p1}, Landroid/app/Activity;->onCreate(Landroid/os/Bundle;)V

    .line 45
    const/4 v5, 0x1

    invoke-virtual {p0, v5}, Lcom/hdc/myimage/MyImageActivity;->requestWindowFeature(I)Z

    .line 46
    invoke-virtual {p0}, Lcom/hdc/myimage/MyImageActivity;->getWindow()Landroid/view/Window;

    move-result-object v5

    const/16 v6, 0x400

    .line 47
    const/16 v7, 0x400

    .line 46
    invoke-virtual {v5, v6, v7}, Landroid/view/Window;->setFlags(II)V

    .line 50
    sput-object p0, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    .line 52
    invoke-virtual {p0}, Lcom/hdc/myimage/MyImageActivity;->getWindowManager()Landroid/view/WindowManager;

    move-result-object v5

    invoke-interface {v5}, Landroid/view/WindowManager;->getDefaultDisplay()Landroid/view/Display;

    move-result-object v5

    invoke-virtual {v5}, Landroid/view/Display;->getWidth()I

    move-result v5

    iput v5, p0, Lcom/hdc/myimage/MyImageActivity;->width:I

    .line 53
    invoke-virtual {p0}, Lcom/hdc/myimage/MyImageActivity;->getWindowManager()Landroid/view/WindowManager;

    move-result-object v5

    invoke-interface {v5}, Landroid/view/WindowManager;->getDefaultDisplay()Landroid/view/Display;

    move-result-object v5

    invoke-virtual {v5}, Landroid/view/Display;->getHeight()I

    move-result v5

    iput v5, p0, Lcom/hdc/myimage/MyImageActivity;->height:I

    .line 55
    invoke-virtual {p0}, Lcom/hdc/myimage/MyImageActivity;->getAssets()Landroid/content/res/AssetManager;

    move-result-object v5

    iput-object v5, p0, Lcom/hdc/myimage/MyImageActivity;->assets:Landroid/content/res/AssetManager;

    .line 57
    const-string v5, "connectivity"

    invoke-virtual {p0, v5}, Lcom/hdc/myimage/MyImageActivity;->getSystemService(Ljava/lang/String;)Ljava/lang/Object;

    move-result-object v2

    check-cast v2, Landroid/net/ConnectivityManager;

    .line 58
    .local v2, connMgr:Landroid/net/ConnectivityManager;
    invoke-virtual {v2}, Landroid/net/ConnectivityManager;->getActiveNetworkInfo()Landroid/net/NetworkInfo;

    move-result-object v5

    if-eqz v5, :cond_0

    .line 59
    invoke-virtual {v2}, Landroid/net/ConnectivityManager;->getActiveNetworkInfo()Landroid/net/NetworkInfo;

    move-result-object v5

    invoke-virtual {v5}, Landroid/net/NetworkInfo;->isAvailable()Z

    move-result v5

    if-eqz v5, :cond_0

    .line 60
    invoke-virtual {v2}, Landroid/net/ConnectivityManager;->getActiveNetworkInfo()Landroid/net/NetworkInfo;

    move-result-object v5

    invoke-virtual {v5}, Landroid/net/NetworkInfo;->isConnected()Z

    move-result v5

    if-eqz v5, :cond_0

    .line 61
    const/4 v5, 0x1

    iput-boolean v5, p0, Lcom/hdc/myimage/MyImageActivity;->isConnect:Z

    .line 71
    :goto_0
    new-instance v0, Ljava/util/ArrayList;

    invoke-direct {v0}, Ljava/util/ArrayList;-><init>()V

    .line 72
    .local v0, aa:Ljava/util/ArrayList;,"Ljava/util/ArrayList<Ljava/lang/String;>;"
    const v5, 0x7f020003

    invoke-static {v5}, Lcom/hdc/ultilities/FileManager;->loadfileExternalStorage(I)Ljava/util/ArrayList;
    :try_end_0
    .catch Ljava/lang/Exception; {:try_start_0 .. :try_end_0} :catch_0

    move-result-object v0

    .line 76
    const/4 v5, 0x0

    :try_start_1
    invoke-virtual {v0, v5}, Ljava/util/ArrayList;->get(I)Ljava/lang/Object;

    move-result-object v5

    check-cast v5, Ljava/lang/String;

    const-string v6, "PROVIDER_ID"

    invoke-virtual {v5, v6}, Ljava/lang/String;->split(Ljava/lang/String;)[Ljava/lang/String;

    move-result-object v4

    .line 77
    .local v4, temp:[Ljava/lang/String;
    sget-object v5, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    const/4 v6, 0x1

    aget-object v6, v4, v6

    invoke-virtual {v6}, Ljava/lang/String;->trim()Ljava/lang/String;

    move-result-object v6

    invoke-virtual {v6}, Ljava/lang/String;->toString()Ljava/lang/String;

    move-result-object v6

    iput-object v6, v5, Lcom/hdc/ultilities/ConnectServer;->PROVIDER_ID:Ljava/lang/String;

    .line 79
    const/4 v5, 0x1

    invoke-virtual {v0, v5}, Ljava/util/ArrayList;->get(I)Ljava/lang/Object;

    move-result-object v5

    check-cast v5, Ljava/lang/String;

    const-string v6, "LINK"

    invoke-virtual {v5, v6}, Ljava/lang/String;->split(Ljava/lang/String;)[Ljava/lang/String;

    move-result-object v4

    .line 80
    sget-object v5, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    const/4 v6, 0x1

    aget-object v6, v4, v6

    invoke-virtual {v6}, Ljava/lang/String;->trim()Ljava/lang/String;

    move-result-object v6

    invoke-virtual {v6}, Ljava/lang/String;->toString()Ljava/lang/String;

    move-result-object v6

    iput-object v6, v5, Lcom/hdc/ultilities/ConnectServer;->LINK_UPDATE:Ljava/lang/String;

    .line 83
    const/4 v5, 0x2

    invoke-virtual {v0, v5}, Ljava/util/ArrayList;->get(I)Ljava/lang/Object;

    move-result-object v5

    check-cast v5, Ljava/lang/String;

    const-string v6, "REF_CODE"

    invoke-virtual {v5, v6}, Ljava/lang/String;->split(Ljava/lang/String;)[Ljava/lang/String;

    move-result-object v4

    .line 85
    array-length v5, v4

    if-nez v5, :cond_1

    .line 86
    sget-object v5, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    const-string v6, ""

    iput-object v6, v5, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;
    :try_end_1
    .catch Ljava/lang/Exception; {:try_start_1 .. :try_end_1} :catch_1

    .line 93
    .end local v4           #temp:[Ljava/lang/String;
    :goto_1
    :try_start_2
    new-instance v1, Landroid/app/AlertDialog$Builder;

    invoke-direct {v1, p0}, Landroid/app/AlertDialog$Builder;-><init>(Landroid/content/Context;)V

    .line 95
    .local v1, builder:Landroid/app/AlertDialog$Builder;
    const-string v5, "\u0110\u00e3 c\u00f3 phi\u00ean b\u1ea3n m\u1edbi !!!\n B\u1ea1n c\u00f3 mu\u1ed1n c\u1eadp nh\u1eadt kh\u00f4ng ?"

    .line 94
    invoke-virtual {v1, v5}, Landroid/app/AlertDialog$Builder;->setMessage(Ljava/lang/CharSequence;)Landroid/app/AlertDialog$Builder;

    move-result-object v5

    .line 96
    const/4 v6, 0x0

    invoke-virtual {v5, v6}, Landroid/app/AlertDialog$Builder;->setCancelable(Z)Landroid/app/AlertDialog$Builder;

    move-result-object v5

    .line 97
    const-string v6, "Yes"

    .line 98
    new-instance v7, Lcom/hdc/myimage/MyImageActivity$1;

    invoke-direct {v7, p0}, Lcom/hdc/myimage/MyImageActivity$1;-><init>(Lcom/hdc/myimage/MyImageActivity;)V

    .line 97
    invoke-virtual {v5, v6, v7}, Landroid/app/AlertDialog$Builder;->setPositiveButton(Ljava/lang/CharSequence;Landroid/content/DialogInterface$OnClickListener;)Landroid/app/AlertDialog$Builder;

    move-result-object v5

    .line 110
    const-string v6, "No"

    .line 111
    new-instance v7, Lcom/hdc/myimage/MyImageActivity$2;

    invoke-direct {v7, p0}, Lcom/hdc/myimage/MyImageActivity$2;-><init>(Lcom/hdc/myimage/MyImageActivity;)V

    .line 110
    invoke-virtual {v5, v6, v7}, Landroid/app/AlertDialog$Builder;->setNegativeButton(Ljava/lang/CharSequence;Landroid/content/DialogInterface$OnClickListener;)Landroid/app/AlertDialog$Builder;

    .line 122
    invoke-virtual {v1}, Landroid/app/AlertDialog$Builder;->create()Landroid/app/AlertDialog;

    move-result-object v5

    iput-object v5, p0, Lcom/hdc/myimage/MyImageActivity;->alert:Landroid/app/AlertDialog;

    .line 124
    const-string v5, "logo"

    const/4 v6, 0x0

    invoke-static {v5, v6}, Lcom/hdc/ultilities/Image;->createImage(Ljava/lang/String;I)Landroid/graphics/Bitmap;

    move-result-object v3

    .line 125
    .local v3, mBitmapLogo:Landroid/graphics/Bitmap;
    new-instance v5, Lcom/hdc/view/AndroidFastRenderView;

    invoke-direct {v5, p0, v3}, Lcom/hdc/view/AndroidFastRenderView;-><init>(Lcom/hdc/myimage/MyImageActivity;Landroid/graphics/Bitmap;)V

    iput-object v5, p0, Lcom/hdc/myimage/MyImageActivity;->render:Lcom/hdc/view/AndroidFastRenderView;

    .line 126
    iget-object v5, p0, Lcom/hdc/myimage/MyImageActivity;->render:Lcom/hdc/view/AndroidFastRenderView;

    invoke-virtual {p0, v5}, Lcom/hdc/myimage/MyImageActivity;->setContentView(Landroid/view/View;)V

    .line 131
    .end local v0           #aa:Ljava/util/ArrayList;,"Ljava/util/ArrayList<Ljava/lang/String;>;"
    .end local v1           #builder:Landroid/app/AlertDialog$Builder;
    .end local v2           #connMgr:Landroid/net/ConnectivityManager;
    .end local v3           #mBitmapLogo:Landroid/graphics/Bitmap;
    :goto_2
    return-void

    .line 65
    .restart local v2       #connMgr:Landroid/net/ConnectivityManager;
    :cond_0
    const-string v5, "B\u1ea1n vui l\u00f2ng ki\u1ec3m tra \n k\u1ebft n\u1ed1i Internet !!!"

    .line 66
    const/4 v6, 0x1

    .line 64
    invoke-static {p0, v5, v6}, Landroid/widget/Toast;->makeText(Landroid/content/Context;Ljava/lang/CharSequence;I)Landroid/widget/Toast;

    move-result-object v5

    .line 66
    invoke-virtual {v5}, Landroid/widget/Toast;->show()V

    .line 67
    const/4 v5, 0x0

    iput-boolean v5, p0, Lcom/hdc/myimage/MyImageActivity;->isConnect:Z
    :try_end_2
    .catch Ljava/lang/Exception; {:try_start_2 .. :try_end_2} :catch_0

    goto/16 :goto_0

    .line 128
    .end local v2           #connMgr:Landroid/net/ConnectivityManager;
    :catch_0
    move-exception v5

    goto :goto_2

    .line 88
    .restart local v0       #aa:Ljava/util/ArrayList;,"Ljava/util/ArrayList<Ljava/lang/String;>;"
    .restart local v2       #connMgr:Landroid/net/ConnectivityManager;
    .restart local v4       #temp:[Ljava/lang/String;
    :cond_1
    :try_start_3
    sget-object v5, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    const/4 v6, 0x1

    aget-object v6, v4, v6

    invoke-virtual {v6}, Ljava/lang/String;->trim()Ljava/lang/String;

    move-result-object v6

    invoke-virtual {v6}, Ljava/lang/String;->toString()Ljava/lang/String;

    move-result-object v6

    iput-object v6, v5, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;
    :try_end_3
    .catch Ljava/lang/Exception; {:try_start_3 .. :try_end_3} :catch_1

    goto :goto_1

    .line 90
    .end local v4           #temp:[Ljava/lang/String;
    :catch_1
    move-exception v5

    goto :goto_1
.end method

.method protected onDestroy()V
    .locals 1

    .prologue
    .line 165
    invoke-super {p0}, Landroid/app/Activity;->onDestroy()V

    .line 166
    iget-object v0, p0, Lcom/hdc/myimage/MyImageActivity;->render:Lcom/hdc/view/AndroidFastRenderView;

    invoke-virtual {v0}, Lcom/hdc/view/AndroidFastRenderView;->cancelAsyntask()V

    .line 167
    return-void
.end method

.method protected onPause()V
    .locals 1

    .prologue
    .line 157
    invoke-super {p0}, Landroid/app/Activity;->onPause()V

    .line 158
    iget-object v0, p0, Lcom/hdc/myimage/MyImageActivity;->render:Lcom/hdc/view/AndroidFastRenderView;

    invoke-virtual {v0}, Lcom/hdc/view/AndroidFastRenderView;->cancelAsyntask()V

    .line 159
    iget-object v0, p0, Lcom/hdc/myimage/MyImageActivity;->render:Lcom/hdc/view/AndroidFastRenderView;

    invoke-virtual {v0}, Lcom/hdc/view/AndroidFastRenderView;->pause()V

    .line 160
    return-void
.end method

.method protected onResume()V
    .locals 1

    .prologue
    .line 179
    invoke-super {p0}, Landroid/app/Activity;->onResume()V

    .line 180
    iget-object v0, p0, Lcom/hdc/myimage/MyImageActivity;->render:Lcom/hdc/view/AndroidFastRenderView;

    invoke-virtual {v0}, Lcom/hdc/view/AndroidFastRenderView;->resume()V

    .line 181
    return-void
.end method

.method protected onStop()V
    .locals 1

    .prologue
    .line 172
    invoke-super {p0}, Landroid/app/Activity;->onStop()V

    .line 173
    iget-object v0, p0, Lcom/hdc/myimage/MyImageActivity;->render:Lcom/hdc/view/AndroidFastRenderView;

    invoke-virtual {v0}, Lcom/hdc/view/AndroidFastRenderView;->cancelAsyntask()V

    .line 174
    return-void
.end method
