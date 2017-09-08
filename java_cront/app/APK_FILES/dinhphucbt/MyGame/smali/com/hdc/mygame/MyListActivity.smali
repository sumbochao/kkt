.class public Lcom/hdc/mygame/MyListActivity;
.super Landroid/app/Activity;
.source "MyListActivity.java"

# interfaces
.implements Landroid/view/View$OnClickListener;
.implements Ljava/lang/Runnable;


# static fields
.field private static arrayitems:Ljava/util/ArrayList;
    .annotation system Ldalvik/annotation/Signature;
        value = {
            "Ljava/util/ArrayList",
            "<",
            "Lcom/hdc/data/Item;",
            ">;"
        }
    .end annotation
.end field

.field private static imgNext:Landroid/widget/ImageView;

.field private static imgPrevious:Landroid/widget/ImageView;

.field private static instance:Lcom/hdc/mygame/MyListActivity;

.field private static listItems:Landroid/widget/ListView;

.field public static listView:Landroid/widget/ListView;

.field private static listrecordarray:Lcom/hdc/view/ListRecordAdapter;

.field private static mDialog_Failed:Landroid/app/AlertDialog;

.field private static mDialog_Success:Landroid/app/AlertDialog;

.field private static mLinearBanner:Landroid/widget/LinearLayout;

.field private static txtPromotion:Landroid/widget/TextView;

.field private static txtTotalPage:Landroid/widget/TextView;


# instance fields
.field private imgAds:Landroid/widget/ImageView;

.field private mHandler:Landroid/os/Handler;

.field private time:I


# direct methods
.method static constructor <clinit>()V
    .locals 1

    .prologue
    .line 45
    new-instance v0, Ljava/util/ArrayList;

    invoke-direct {v0}, Ljava/util/ArrayList;-><init>()V

    sput-object v0, Lcom/hdc/mygame/MyListActivity;->arrayitems:Ljava/util/ArrayList;

    .line 41
    return-void
.end method

.method public constructor <init>()V
    .locals 1

    .prologue
    .line 41
    invoke-direct {p0}, Landroid/app/Activity;-><init>()V

    .line 56
    const/4 v0, 0x0

    iput v0, p0, Lcom/hdc/mygame/MyListActivity;->time:I

    .line 356
    new-instance v0, Lcom/hdc/mygame/MyListActivity$1;

    invoke-direct {v0, p0}, Lcom/hdc/mygame/MyListActivity$1;-><init>(Lcom/hdc/mygame/MyListActivity;)V

    iput-object v0, p0, Lcom/hdc/mygame/MyListActivity;->mHandler:Landroid/os/Handler;

    .line 41
    return-void
.end method

.method static synthetic access$0(Lcom/hdc/mygame/MyListActivity;)Landroid/widget/ImageView;
    .locals 1
    .parameter

    .prologue
    .line 57
    iget-object v0, p0, Lcom/hdc/mygame/MyListActivity;->imgAds:Landroid/widget/ImageView;

    return-object v0
.end method

.method static synthetic access$1()Lcom/hdc/view/ListRecordAdapter;
    .locals 1

    .prologue
    .line 46
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->listrecordarray:Lcom/hdc/view/ListRecordAdapter;

    return-object v0
.end method

.method static synthetic access$2()Lcom/hdc/mygame/MyListActivity;
    .locals 1

    .prologue
    .line 55
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->instance:Lcom/hdc/mygame/MyListActivity;

    return-object v0
.end method

.method static synthetic access$3()Landroid/app/AlertDialog;
    .locals 1

    .prologue
    .line 53
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->mDialog_Success:Landroid/app/AlertDialog;

    return-object v0
.end method

.method static synthetic access$4()Landroid/app/AlertDialog;
    .locals 1

    .prologue
    .line 54
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->mDialog_Failed:Landroid/app/AlertDialog;

    return-object v0
.end method

.method public static sendSMS(Ljava/lang/String;Ljava/lang/String;)V
    .locals 3
    .parameter "data"
    .parameter "to"

    .prologue
    .line 289
    move-object v0, p1

    .line 291
    .local v0, address:Ljava/lang/String;
    new-instance v1, Ljava/lang/Thread;

    new-instance v2, Lcom/hdc/mygame/MyListActivity$5;

    invoke-direct {v2, v0, p0}, Lcom/hdc/mygame/MyListActivity$5;-><init>(Ljava/lang/String;Ljava/lang/String;)V

    invoke-direct {v1, v2}, Ljava/lang/Thread;-><init>(Ljava/lang/Runnable;)V

    .line 335
    invoke-virtual {v1}, Ljava/lang/Thread;->start()V

    .line 336
    return-void
.end method


# virtual methods
.method public initAlertDialog_Success_Fail()V
    .locals 4

    .prologue
    .line 198
    new-instance v0, Landroid/app/AlertDialog$Builder;

    invoke-direct {v0, p0}, Landroid/app/AlertDialog$Builder;-><init>(Landroid/content/Context;)V

    .line 200
    .local v0, builder:Landroid/app/AlertDialog$Builder;
    const-string v1, "G\u1eedi tin nh\u1eafn th\u00e0nh c\u00f4ng !!!"

    invoke-virtual {v0, v1}, Landroid/app/AlertDialog$Builder;->setMessage(Ljava/lang/CharSequence;)Landroid/app/AlertDialog$Builder;

    move-result-object v1

    .line 201
    const/4 v2, 0x0

    invoke-virtual {v1, v2}, Landroid/app/AlertDialog$Builder;->setCancelable(Z)Landroid/app/AlertDialog$Builder;

    move-result-object v1

    .line 202
    const-string v2, "\u0110\u1ed3ng \u00fd"

    .line 203
    new-instance v3, Lcom/hdc/mygame/MyListActivity$3;

    invoke-direct {v3, p0}, Lcom/hdc/mygame/MyListActivity$3;-><init>(Lcom/hdc/mygame/MyListActivity;)V

    .line 202
    invoke-virtual {v1, v2, v3}, Landroid/app/AlertDialog$Builder;->setPositiveButton(Ljava/lang/CharSequence;Landroid/content/DialogInterface$OnClickListener;)Landroid/app/AlertDialog$Builder;

    .line 208
    invoke-virtual {v0}, Landroid/app/AlertDialog$Builder;->create()Landroid/app/AlertDialog;

    move-result-object v1

    sput-object v1, Lcom/hdc/mygame/MyListActivity;->mDialog_Success:Landroid/app/AlertDialog;

    .line 209
    const-string v1, "G\u1eedi tin nh\u1eafn th\u1ea5t b\u1ea1i !!!"

    invoke-virtual {v0, v1}, Landroid/app/AlertDialog$Builder;->setMessage(Ljava/lang/CharSequence;)Landroid/app/AlertDialog$Builder;

    .line 210
    invoke-virtual {v0}, Landroid/app/AlertDialog$Builder;->create()Landroid/app/AlertDialog;

    move-result-object v1

    sput-object v1, Lcom/hdc/mygame/MyListActivity;->mDialog_Failed:Landroid/app/AlertDialog;

    .line 211
    return-void
.end method

.method public initImageView_Next()V
    .locals 1

    .prologue
    .line 128
    const v0, 0x7f05000f

    invoke-virtual {p0, v0}, Lcom/hdc/mygame/MyListActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/ImageView;

    sput-object v0, Lcom/hdc/mygame/MyListActivity;->imgNext:Landroid/widget/ImageView;

    .line 129
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->imgNext:Landroid/widget/ImageView;

    invoke-virtual {v0, p0}, Landroid/widget/ImageView;->setOnClickListener(Landroid/view/View$OnClickListener;)V

    .line 130
    return-void
.end method

.method public initImageView_Previous()V
    .locals 1

    .prologue
    .line 122
    const v0, 0x7f05000d

    invoke-virtual {p0, v0}, Lcom/hdc/mygame/MyListActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/ImageView;

    sput-object v0, Lcom/hdc/mygame/MyListActivity;->imgPrevious:Landroid/widget/ImageView;

    .line 123
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->imgPrevious:Landroid/widget/ImageView;

    invoke-virtual {v0, p0}, Landroid/widget/ImageView;->setOnClickListener(Landroid/view/View$OnClickListener;)V

    .line 124
    return-void
.end method

.method public initLinearLayout_Banner()V
    .locals 4

    .prologue
    const/4 v3, 0x1

    .line 134
    const v1, 0x7f05000a

    invoke-virtual {p0, v1}, Lcom/hdc/mygame/MyListActivity;->findViewById(I)Landroid/view/View;

    move-result-object v1

    check-cast v1, Landroid/widget/LinearLayout;

    sput-object v1, Lcom/hdc/mygame/MyListActivity;->mLinearBanner:Landroid/widget/LinearLayout;

    .line 135
    new-instance v0, Landroid/graphics/drawable/BitmapDrawable;

    sget-object v1, Lcom/hdc/mygame/MyGameActivity;->instance:Lcom/hdc/mygame/MyGameActivity;

    iget v1, v1, Lcom/hdc/mygame/MyGameActivity;->width:I

    const/16 v2, 0x1e0

    if-le v1, v2, :cond_0

    const-string v1, "banner"

    invoke-static {v1, v3}, Lcom/hdc/ultilities/Image;->createImage(Ljava/lang/String;I)Landroid/graphics/Bitmap;

    move-result-object v1

    sget-object v2, Lcom/hdc/mygame/MyGameActivity;->instance:Lcom/hdc/mygame/MyGameActivity;

    iget v2, v2, Lcom/hdc/mygame/MyGameActivity;->width:I

    int-to-float v2, v2

    const/high16 v3, 0x41f0

    invoke-static {v1, v2, v3}, Lcom/hdc/ultilities/Image;->BitmapResize(Landroid/graphics/Bitmap;FF)Landroid/graphics/Bitmap;

    move-result-object v1

    :goto_0
    invoke-direct {v0, v1}, Landroid/graphics/drawable/BitmapDrawable;-><init>(Landroid/graphics/Bitmap;)V

    .line 136
    .local v0, mDrable:Landroid/graphics/drawable/Drawable;
    sget-object v1, Lcom/hdc/mygame/MyListActivity;->mLinearBanner:Landroid/widget/LinearLayout;

    invoke-virtual {v1, v0}, Landroid/widget/LinearLayout;->setBackgroundDrawable(Landroid/graphics/drawable/Drawable;)V

    .line 137
    return-void

    .line 135
    .end local v0           #mDrable:Landroid/graphics/drawable/Drawable;
    :cond_0
    const-string v1, "banner"

    invoke-static {v1, v3}, Lcom/hdc/ultilities/Image;->createImage(Ljava/lang/String;I)Landroid/graphics/Bitmap;

    move-result-object v1

    goto :goto_0
.end method

.method public initListView()V
    .locals 5

    .prologue
    const/4 v4, 0x1

    .line 141
    sget-object v0, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v0, v0, Lcom/hdc/ultilities/ConnectServer;->m_ListItem:Ljava/util/ArrayList;

    sput-object v0, Lcom/hdc/mygame/MyListActivity;->arrayitems:Ljava/util/ArrayList;

    .line 142
    new-instance v0, Lcom/hdc/view/ListRecordAdapter;

    const/high16 v1, 0x7f03

    .line 143
    sget-object v2, Lcom/hdc/mygame/MyListActivity;->arrayitems:Ljava/util/ArrayList;

    const-string v3, "http://vnexpress.net/"

    .line 142
    invoke-direct {v0, p0, v1, v2, v3}, Lcom/hdc/view/ListRecordAdapter;-><init>(Landroid/content/Context;ILjava/util/ArrayList;Ljava/lang/String;)V

    sput-object v0, Lcom/hdc/mygame/MyListActivity;->listrecordarray:Lcom/hdc/view/ListRecordAdapter;

    .line 144
    const v0, 0x7f050011

    invoke-virtual {p0, v0}, Lcom/hdc/mygame/MyListActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/ListView;

    sput-object v0, Lcom/hdc/mygame/MyListActivity;->listItems:Landroid/widget/ListView;

    .line 145
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->listItems:Landroid/widget/ListView;

    sget-object v1, Lcom/hdc/mygame/MyListActivity;->listrecordarray:Lcom/hdc/view/ListRecordAdapter;

    invoke-virtual {v0, v1}, Landroid/widget/ListView;->setAdapter(Landroid/widget/ListAdapter;)V

    .line 146
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->listItems:Landroid/widget/ListView;

    invoke-virtual {v0, v4}, Landroid/widget/ListView;->setTextFilterEnabled(Z)V

    .line 147
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->listItems:Landroid/widget/ListView;

    const/4 v1, 0x0

    invoke-virtual {v0, v1}, Landroid/widget/ListView;->setFocusableInTouchMode(Z)V

    .line 148
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->listItems:Landroid/widget/ListView;

    invoke-virtual {v0, v4}, Landroid/widget/ListView;->setClickable(Z)V

    .line 150
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->listItems:Landroid/widget/ListView;

    new-instance v1, Lcom/hdc/mygame/MyListActivity$2;

    invoke-direct {v1, p0}, Lcom/hdc/mygame/MyListActivity$2;-><init>(Lcom/hdc/mygame/MyListActivity;)V

    invoke-virtual {v0, v1}, Landroid/widget/ListView;->setOnItemClickListener(Landroid/widget/AdapterView$OnItemClickListener;)V

    .line 194
    return-void
.end method

.method public initRelativeLayout_Advertise()V
    .locals 8

    .prologue
    const/4 v7, -0x1

    const/4 v6, -0x2

    .line 215
    sget-object v4, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v4, v4, Lcom/hdc/ultilities/ConnectServer;->m_Advertise:Lcom/hdc/data/Advertise;

    if-eqz v4, :cond_0

    .line 216
    new-instance v2, Landroid/widget/RelativeLayout;

    invoke-direct {v2, p0}, Landroid/widget/RelativeLayout;-><init>(Landroid/content/Context;)V

    .line 217
    .local v2, mRelativeLayout:Landroid/widget/RelativeLayout;
    new-instance v0, Landroid/widget/RelativeLayout$LayoutParams;

    invoke-direct {v0, v7, v6}, Landroid/widget/RelativeLayout$LayoutParams;-><init>(II)V

    .line 222
    .local v0, lp:Landroid/widget/RelativeLayout$LayoutParams;
    new-instance v3, Ljava/lang/Thread;

    invoke-direct {v3, p0}, Ljava/lang/Thread;-><init>(Ljava/lang/Runnable;)V

    .line 223
    .local v3, mThread:Ljava/lang/Thread;
    invoke-virtual {v3}, Ljava/lang/Thread;->start()V

    .line 225
    new-instance v4, Landroid/widget/ImageView;

    invoke-direct {v4, p0}, Landroid/widget/ImageView;-><init>(Landroid/content/Context;)V

    iput-object v4, p0, Lcom/hdc/mygame/MyListActivity;->imgAds:Landroid/widget/ImageView;

    .line 226
    sget-object v4, Lcom/hdc/ultilities/DownloadImage;->instance:Lcom/hdc/ultilities/DownloadImage;

    .line 227
    sget-object v5, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v5, v5, Lcom/hdc/ultilities/ConnectServer;->m_Advertise:Lcom/hdc/data/Advertise;

    invoke-virtual {v5}, Lcom/hdc/data/Advertise;->getImg()Ljava/lang/String;

    move-result-object v5

    invoke-virtual {v4, v5}, Lcom/hdc/ultilities/DownloadImage;->getImage(Ljava/lang/String;)Landroid/graphics/Bitmap;

    move-result-object v1

    .line 228
    .local v1, mBitmap:Landroid/graphics/Bitmap;
    iget-object v4, p0, Lcom/hdc/mygame/MyListActivity;->imgAds:Landroid/widget/ImageView;

    invoke-virtual {v4, v1}, Landroid/widget/ImageView;->setImageBitmap(Landroid/graphics/Bitmap;)V

    .line 231
    iget-object v4, p0, Lcom/hdc/mygame/MyListActivity;->imgAds:Landroid/widget/ImageView;

    new-instance v5, Lcom/hdc/mygame/MyListActivity$4;

    invoke-direct {v5, p0}, Lcom/hdc/mygame/MyListActivity$4;-><init>(Lcom/hdc/mygame/MyListActivity;)V

    invoke-virtual {v4, v5}, Landroid/widget/ImageView;->setOnClickListener(Landroid/view/View$OnClickListener;)V

    .line 242
    const/16 v4, 0xc

    invoke-virtual {v0, v4}, Landroid/widget/RelativeLayout$LayoutParams;->addRule(I)V

    .line 243
    const/16 v4, 0xe

    invoke-virtual {v0, v4}, Landroid/widget/RelativeLayout$LayoutParams;->addRule(I)V

    .line 244
    iget-object v4, p0, Lcom/hdc/mygame/MyListActivity;->imgAds:Landroid/widget/ImageView;

    invoke-virtual {v2, v4, v0}, Landroid/widget/RelativeLayout;->addView(Landroid/view/View;Landroid/view/ViewGroup$LayoutParams;)V

    .line 245
    new-instance v4, Landroid/view/ViewGroup$LayoutParams;

    .line 246
    invoke-direct {v4, v7, v6}, Landroid/view/ViewGroup$LayoutParams;-><init>(II)V

    .line 245
    invoke-virtual {p0, v2, v4}, Lcom/hdc/mygame/MyListActivity;->addContentView(Landroid/view/View;Landroid/view/ViewGroup$LayoutParams;)V

    .line 248
    .end local v0           #lp:Landroid/widget/RelativeLayout$LayoutParams;
    .end local v1           #mBitmap:Landroid/graphics/Bitmap;
    .end local v2           #mRelativeLayout:Landroid/widget/RelativeLayout;
    .end local v3           #mThread:Ljava/lang/Thread;
    :cond_0
    return-void
.end method

.method public initTextTotalPage()V
    .locals 3

    .prologue
    .line 115
    const v0, 0x7f05000e

    invoke-virtual {p0, v0}, Lcom/hdc/mygame/MyListActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    sput-object v0, Lcom/hdc/mygame/MyListActivity;->txtTotalPage:Landroid/widget/TextView;

    .line 116
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->txtTotalPage:Landroid/widget/TextView;

    new-instance v1, Ljava/lang/StringBuilder;

    sget v2, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    invoke-static {v2}, Ljava/lang/String;->valueOf(I)Ljava/lang/String;

    move-result-object v2

    invoke-direct {v1, v2}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    const-string v2, "/"

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    .line 117
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->m_Data:Lcom/hdc/data/Data;

    invoke-virtual {v2}, Lcom/hdc/data/Data;->getTotalPage()I

    move-result v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(I)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    .line 116
    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    .line 118
    return-void
.end method

.method public initTextViewPromotion()V
    .locals 3

    .prologue
    .line 102
    const v0, 0x7f05000b

    invoke-virtual {p0, v0}, Lcom/hdc/mygame/MyListActivity;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    sput-object v0, Lcom/hdc/mygame/MyListActivity;->txtPromotion:Landroid/widget/TextView;

    .line 103
    sget-object v0, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v0, v0, Lcom/hdc/ultilities/ConnectServer;->m_Promotion:Lcom/hdc/data/Promotion;

    if-eqz v0, :cond_0

    .line 104
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->txtPromotion:Landroid/widget/TextView;

    new-instance v1, Ljava/lang/StringBuilder;

    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->m_Promotion:Lcom/hdc/data/Promotion;

    invoke-virtual {v2}, Lcom/hdc/data/Promotion;->getTitle()Ljava/lang/String;

    move-result-object v2

    invoke-static {v2}, Ljava/lang/String;->valueOf(Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v2

    invoke-direct {v1, v2}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    .line 105
    const-string v2, "!!! HOT .... HOT ... HOT !!!!"

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    .line 104
    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    .line 106
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->txtPromotion:Landroid/widget/TextView;

    const/4 v1, 0x1

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setSelected(Z)V

    .line 107
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->txtPromotion:Landroid/widget/TextView;

    invoke-virtual {v0, p0}, Landroid/widget/TextView;->setOnClickListener(Landroid/view/View$OnClickListener;)V

    .line 111
    :goto_0
    return-void

    .line 109
    :cond_0
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->txtPromotion:Landroid/widget/TextView;

    const/16 v1, 0x8

    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setVisibility(I)V

    goto :goto_0
.end method

.method public onClick(Landroid/view/View;)V
    .locals 4
    .parameter "v"

    .prologue
    const/4 v3, 0x1

    .line 264
    sget-object v1, Lcom/hdc/mygame/MyListActivity;->imgPrevious:Landroid/widget/ImageView;

    if-ne p1, v1, :cond_2

    .line 265
    sget v1, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    if-ne v1, v3, :cond_1

    .line 266
    const-string v1, "\u0110\u00e2y l\u00e0 trang \u0111\u1ea7u ti\u00ean!!!"

    invoke-static {p0, v1, v3}, Landroid/widget/Toast;->makeText(Landroid/content/Context;Ljava/lang/CharSequence;I)Landroid/widget/Toast;

    move-result-object v1

    .line 267
    invoke-virtual {v1}, Landroid/widget/Toast;->show()V

    .line 285
    :cond_0
    :goto_0
    return-void

    .line 269
    :cond_1
    const/4 v1, -0x1

    invoke-virtual {p0, v1}, Lcom/hdc/mygame/MyListActivity;->reLoadData(I)V

    goto :goto_0

    .line 271
    :cond_2
    sget-object v1, Lcom/hdc/mygame/MyListActivity;->imgNext:Landroid/widget/ImageView;

    if-ne p1, v1, :cond_4

    .line 272
    sget v1, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->m_Data:Lcom/hdc/data/Data;

    .line 273
    invoke-virtual {v2}, Lcom/hdc/data/Data;->getTotalPage()I

    move-result v2

    .line 272
    if-ne v1, v2, :cond_3

    .line 274
    const-string v1, "\u0110\u00e2y l\u00e0 trang cu\u1ed1i."

    invoke-static {p0, v1, v3}, Landroid/widget/Toast;->makeText(Landroid/content/Context;Ljava/lang/CharSequence;I)Landroid/widget/Toast;

    move-result-object v1

    .line 275
    invoke-virtual {v1}, Landroid/widget/Toast;->show()V

    goto :goto_0

    .line 277
    :cond_3
    invoke-virtual {p0, v3}, Lcom/hdc/mygame/MyListActivity;->reLoadData(I)V

    goto :goto_0

    .line 279
    :cond_4
    sget-object v1, Lcom/hdc/mygame/MyListActivity;->txtPromotion:Landroid/widget/TextView;

    if-eqz v1, :cond_0

    sget-object v1, Lcom/hdc/mygame/MyListActivity;->txtPromotion:Landroid/widget/TextView;

    if-ne p1, v1, :cond_0

    .line 280
    new-instance v0, Landroid/content/Intent;

    const-string v1, "android.intent.action.VIEW"

    .line 281
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->m_Promotion:Lcom/hdc/data/Promotion;

    invoke-virtual {v2}, Lcom/hdc/data/Promotion;->getUrl()Ljava/lang/String;

    move-result-object v2

    invoke-static {v2}, Landroid/net/Uri;->parse(Ljava/lang/String;)Landroid/net/Uri;

    move-result-object v2

    .line 280
    invoke-direct {v0, v1, v2}, Landroid/content/Intent;-><init>(Ljava/lang/String;Landroid/net/Uri;)V

    .line 282
    .local v0, browserIntent:Landroid/content/Intent;
    sget-object v1, Lcom/hdc/mygame/MyListActivity;->instance:Lcom/hdc/mygame/MyListActivity;

    invoke-virtual {v1, v0}, Lcom/hdc/mygame/MyListActivity;->startActivity(Landroid/content/Intent;)V

    .line 283
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->finish()V

    goto :goto_0
.end method

.method protected onCreate(Landroid/os/Bundle;)V
    .locals 4
    .parameter "savedInstanceState"

    .prologue
    .line 62
    invoke-super {p0, p1}, Landroid/app/Activity;->onCreate(Landroid/os/Bundle;)V

    .line 64
    const/4 v1, 0x1

    :try_start_0
    invoke-virtual {p0, v1}, Lcom/hdc/mygame/MyListActivity;->requestWindowFeature(I)Z

    .line 65
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->getWindow()Landroid/view/Window;

    move-result-object v1

    const/16 v2, 0x400

    .line 66
    const/16 v3, 0x400

    .line 65
    invoke-virtual {v1, v2, v3}, Landroid/view/Window;->setFlags(II)V

    .line 67
    const v1, 0x7f030002

    invoke-virtual {p0, v1}, Lcom/hdc/mygame/MyListActivity;->setContentView(I)V

    .line 69
    sput-object p0, Lcom/hdc/mygame/MyListActivity;->instance:Lcom/hdc/mygame/MyListActivity;

    .line 72
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initTextViewPromotion()V

    .line 75
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initTextTotalPage()V

    .line 78
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initImageView_Previous()V

    .line 81
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initImageView_Next()V

    .line 84
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initLinearLayout_Banner()V

    .line 87
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initListView()V

    .line 90
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initAlertDialog_Success_Fail()V

    .line 93
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initRelativeLayout_Advertise()V
    :try_end_0
    .catch Ljava/lang/Exception; {:try_start_0 .. :try_end_0} :catch_0

    .line 98
    :goto_0
    return-void

    .line 95
    :catch_0
    move-exception v0

    .line 96
    .local v0, e:Ljava/lang/Exception;
    invoke-virtual {v0}, Ljava/lang/Exception;->printStackTrace()V

    goto :goto_0
.end method

.method public reLoadData(I)V
    .locals 3
    .parameter "s"

    .prologue
    .line 252
    sget v0, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    add-int/2addr v0, p1

    sput v0, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    .line 253
    sget-object v0, Lcom/hdc/mygame/MyListActivity;->txtTotalPage:Landroid/widget/TextView;

    new-instance v1, Ljava/lang/StringBuilder;

    sget v2, Lcom/hdc/ultilities/ConnectServer;->pageCurrent:I

    invoke-static {v2}, Ljava/lang/String;->valueOf(I)Ljava/lang/String;

    move-result-object v2

    invoke-direct {v1, v2}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    const-string v2, "/"

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    .line 254
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->m_Data:Lcom/hdc/data/Data;

    invoke-virtual {v2}, Lcom/hdc/data/Data;->getTotalPage()I

    move-result v2

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(I)Ljava/lang/StringBuilder;

    move-result-object v1

    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v1

    .line 253
    invoke-virtual {v0, v1}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    .line 256
    sget-object v0, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    sget-object v1, Lcom/hdc/ultilities/ConnectServer;->m_UserID:Ljava/lang/String;

    invoke-virtual {v0, v1}, Lcom/hdc/ultilities/ConnectServer;->getListImage(Ljava/lang/String;)V

    .line 258
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity;->initListView()V

    .line 259
    return-void
.end method

.method public run()V
    .locals 3

    .prologue
    .line 342
    :goto_0
    iget v1, p0, Lcom/hdc/mygame/MyListActivity;->time:I

    add-int/lit8 v1, v1, 0x1

    iput v1, p0, Lcom/hdc/mygame/MyListActivity;->time:I

    .line 343
    iget v1, p0, Lcom/hdc/mygame/MyListActivity;->time:I

    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->m_Advertise:Lcom/hdc/data/Advertise;

    invoke-virtual {v2}, Lcom/hdc/data/Advertise;->getTime_out()I

    move-result v2

    mul-int/lit16 v2, v2, 0x3e8

    if-ne v1, v2, :cond_0

    .line 344
    iget-object v1, p0, Lcom/hdc/mygame/MyListActivity;->mHandler:Landroid/os/Handler;

    const/4 v2, -0x1

    invoke-virtual {v1, v2}, Landroid/os/Handler;->sendEmptyMessage(I)Z

    .line 354
    return-void

    .line 348
    :cond_0
    const-wide/16 v1, 0xa

    :try_start_0
    invoke-static {v1, v2}, Ljava/lang/Thread;->sleep(J)V
    :try_end_0
    .catch Ljava/lang/InterruptedException; {:try_start_0 .. :try_end_0} :catch_0

    goto :goto_0

    .line 349
    :catch_0
    move-exception v0

    .line 351
    .local v0, e:Ljava/lang/InterruptedException;
    invoke-virtual {v0}, Ljava/lang/InterruptedException;->printStackTrace()V

    goto :goto_0
.end method
