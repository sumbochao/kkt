.class public Lcom/hdc/data/Promotion;
.super Ljava/lang/Object;
.source "Promotion.java"


# instance fields
.field public id:Ljava/lang/String;

.field public title:Ljava/lang/String;

.field public type:Ljava/lang/String;

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
.method public getId()Ljava/lang/String;
    .locals 1

    .prologue
    .line 10
    iget-object v0, p0, Lcom/hdc/data/Promotion;->id:Ljava/lang/String;

    return-object v0
.end method

.method public getTitle()Ljava/lang/String;
    .locals 1

    .prologue
    .line 18
    iget-object v0, p0, Lcom/hdc/data/Promotion;->title:Ljava/lang/String;

    return-object v0
.end method

.method public getType()Ljava/lang/String;
    .locals 1

    .prologue
    .line 26
    iget-object v0, p0, Lcom/hdc/data/Promotion;->type:Ljava/lang/String;

    return-object v0
.end method

.method public getUrl()Ljava/lang/String;
    .locals 1

    .prologue
    .line 34
    iget-object v0, p0, Lcom/hdc/data/Promotion;->url:Ljava/lang/String;

    return-object v0
.end method

.method public setId(Ljava/lang/String;)V
    .locals 0
    .parameter "id"

    .prologue
    .line 14
    iput-object p1, p0, Lcom/hdc/data/Promotion;->id:Ljava/lang/String;

    .line 15
    return-void
.end method

.method public setTitle(Ljava/lang/String;)V
    .locals 0
    .parameter "title"

    .prologue
    .line 22
    iput-object p1, p0, Lcom/hdc/data/Promotion;->title:Ljava/lang/String;

    .line 23
    return-void
.end method

.method public setType(Ljava/lang/String;)V
    .locals 0
    .parameter "type"

    .prologue
    .line 30
    iput-object p1, p0, Lcom/hdc/data/Promotion;->type:Ljava/lang/String;

    .line 31
    return-void
.end method

.method public setUrl(Ljava/lang/String;)V
    .locals 0
    .parameter "url"

    .prologue
    .line 38
    iput-object p1, p0, Lcom/hdc/data/Promotion;->url:Ljava/lang/String;

    .line 39
    return-void
.end method
