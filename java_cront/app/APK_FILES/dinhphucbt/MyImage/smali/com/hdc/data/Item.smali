.class public Lcom/hdc/data/Item;
.super Ljava/lang/Object;
.source "Item.java"


# instance fields
.field public height:I

.field public id:Ljava/lang/String;

.field public img:Landroid/graphics/Bitmap;

.field public info:Ljava/lang/String;

.field public src:Ljava/lang/String;

.field public summary:Ljava/lang/String;

.field public title:Ljava/lang/String;

.field public width:I


# direct methods
.method public constructor <init>()V
    .locals 0

    .prologue
    .line 5
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public getHeight()I
    .locals 1

    .prologue
    .line 64
    iget v0, p0, Lcom/hdc/data/Item;->height:I

    return v0
.end method

.method public getId()Ljava/lang/String;
    .locals 1

    .prologue
    .line 24
    iget-object v0, p0, Lcom/hdc/data/Item;->id:Ljava/lang/String;

    return-object v0
.end method

.method public getImg()Landroid/graphics/Bitmap;
    .locals 1

    .prologue
    .line 13
    iget-object v0, p0, Lcom/hdc/data/Item;->img:Landroid/graphics/Bitmap;

    return-object v0
.end method

.method public getInfo()Ljava/lang/String;
    .locals 1

    .prologue
    .line 40
    iget-object v0, p0, Lcom/hdc/data/Item;->info:Ljava/lang/String;

    return-object v0
.end method

.method public getSrc()Ljava/lang/String;
    .locals 1

    .prologue
    .line 72
    iget-object v0, p0, Lcom/hdc/data/Item;->src:Ljava/lang/String;

    return-object v0
.end method

.method public getSummary()Ljava/lang/String;
    .locals 1

    .prologue
    .line 48
    iget-object v0, p0, Lcom/hdc/data/Item;->summary:Ljava/lang/String;

    return-object v0
.end method

.method public getTitle()Ljava/lang/String;
    .locals 1

    .prologue
    .line 32
    iget-object v0, p0, Lcom/hdc/data/Item;->title:Ljava/lang/String;

    return-object v0
.end method

.method public getWidth()I
    .locals 1

    .prologue
    .line 56
    iget v0, p0, Lcom/hdc/data/Item;->width:I

    return v0
.end method

.method public setHeight(I)V
    .locals 0
    .parameter "height"

    .prologue
    .line 68
    iput p1, p0, Lcom/hdc/data/Item;->height:I

    .line 69
    return-void
.end method

.method public setId(Ljava/lang/String;)V
    .locals 0
    .parameter "id"

    .prologue
    .line 28
    iput-object p1, p0, Lcom/hdc/data/Item;->id:Ljava/lang/String;

    .line 29
    return-void
.end method

.method public setImg(Landroid/graphics/Bitmap;)V
    .locals 0
    .parameter "img"

    .prologue
    .line 17
    iput-object p1, p0, Lcom/hdc/data/Item;->img:Landroid/graphics/Bitmap;

    .line 18
    return-void
.end method

.method public setInfo(Ljava/lang/String;)V
    .locals 0
    .parameter "info"

    .prologue
    .line 44
    iput-object p1, p0, Lcom/hdc/data/Item;->info:Ljava/lang/String;

    .line 45
    return-void
.end method

.method public setSrc(Ljava/lang/String;)V
    .locals 0
    .parameter "src"

    .prologue
    .line 76
    iput-object p1, p0, Lcom/hdc/data/Item;->src:Ljava/lang/String;

    .line 77
    return-void
.end method

.method public setSummary(Ljava/lang/String;)V
    .locals 0
    .parameter "summary"

    .prologue
    .line 52
    iput-object p1, p0, Lcom/hdc/data/Item;->summary:Ljava/lang/String;

    .line 53
    return-void
.end method

.method public setTitle(Ljava/lang/String;)V
    .locals 0
    .parameter "title"

    .prologue
    .line 36
    iput-object p1, p0, Lcom/hdc/data/Item;->title:Ljava/lang/String;

    .line 37
    return-void
.end method

.method public setWidth(I)V
    .locals 0
    .parameter "width"

    .prologue
    .line 60
    iput p1, p0, Lcom/hdc/data/Item;->width:I

    .line 61
    return-void
.end method
