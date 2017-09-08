.class public Lcom/hdc/data/Data;
.super Ljava/lang/Object;
.source "Data.java"


# instance fields
.field public totalPage:I

.field public type:Ljava/lang/String;

.field public typeAction:Ljava/lang/String;

.field public url:Ljava/lang/String;


# direct methods
.method public constructor <init>()V
    .locals 0

    .prologue
    .line 3
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public getTotalPage()I
    .locals 1

    .prologue
    .line 8
    iget v0, p0, Lcom/hdc/data/Data;->totalPage:I

    return v0
.end method

.method public getType()Ljava/lang/String;
    .locals 1

    .prologue
    .line 18
    iget-object v0, p0, Lcom/hdc/data/Data;->type:Ljava/lang/String;

    return-object v0
.end method

.method public getTypeAction()Ljava/lang/String;
    .locals 1

    .prologue
    .line 26
    iget-object v0, p0, Lcom/hdc/data/Data;->typeAction:Ljava/lang/String;

    return-object v0
.end method

.method public getUrl()Ljava/lang/String;
    .locals 1

    .prologue
    .line 34
    iget-object v0, p0, Lcom/hdc/data/Data;->url:Ljava/lang/String;

    return-object v0
.end method

.method public setTotalPage(I)V
    .locals 0
    .parameter "totalPage"

    .prologue
    .line 12
    iput p1, p0, Lcom/hdc/data/Data;->totalPage:I

    .line 13
    return-void
.end method

.method public setType(Ljava/lang/String;)V
    .locals 0
    .parameter "type"

    .prologue
    .line 22
    iput-object p1, p0, Lcom/hdc/data/Data;->type:Ljava/lang/String;

    .line 23
    return-void
.end method

.method public setTypeAction(Ljava/lang/String;)V
    .locals 0
    .parameter "typeAction"

    .prologue
    .line 30
    iput-object p1, p0, Lcom/hdc/data/Data;->typeAction:Ljava/lang/String;

    .line 31
    return-void
.end method

.method public setUrl(Ljava/lang/String;)V
    .locals 0
    .parameter "url"

    .prologue
    .line 38
    iput-object p1, p0, Lcom/hdc/data/Data;->url:Ljava/lang/String;

    .line 39
    return-void
.end method
