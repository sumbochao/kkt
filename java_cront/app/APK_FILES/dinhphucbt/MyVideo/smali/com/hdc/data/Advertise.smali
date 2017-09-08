.class public Lcom/hdc/data/Advertise;
.super Ljava/lang/Object;
.source "Advertise.java"


# instance fields
.field public img:Ljava/lang/String;

.field public message:Ljava/lang/String;

.field public time_out:I

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
.method public getImg()Ljava/lang/String;
    .locals 1

    .prologue
    .line 17
    iget-object v0, p0, Lcom/hdc/data/Advertise;->img:Ljava/lang/String;

    return-object v0
.end method

.method public getMessage()Ljava/lang/String;
    .locals 1

    .prologue
    .line 11
    iget-object v0, p0, Lcom/hdc/data/Advertise;->message:Ljava/lang/String;

    return-object v0
.end method

.method public getTime_out()I
    .locals 1

    .prologue
    .line 23
    iget v0, p0, Lcom/hdc/data/Advertise;->time_out:I

    return v0
.end method

.method public getType()Ljava/lang/String;
    .locals 1

    .prologue
    .line 29
    iget-object v0, p0, Lcom/hdc/data/Advertise;->type:Ljava/lang/String;

    return-object v0
.end method

.method public getUrl()Ljava/lang/String;
    .locals 1

    .prologue
    .line 35
    iget-object v0, p0, Lcom/hdc/data/Advertise;->url:Ljava/lang/String;

    return-object v0
.end method

.method public setImg(Ljava/lang/String;)V
    .locals 0
    .parameter "img"

    .prologue
    .line 20
    iput-object p1, p0, Lcom/hdc/data/Advertise;->img:Ljava/lang/String;

    .line 21
    return-void
.end method

.method public setMessage(Ljava/lang/String;)V
    .locals 0
    .parameter "message"

    .prologue
    .line 14
    iput-object p1, p0, Lcom/hdc/data/Advertise;->message:Ljava/lang/String;

    .line 15
    return-void
.end method

.method public setTime_out(I)V
    .locals 0
    .parameter "time_out"

    .prologue
    .line 26
    iput p1, p0, Lcom/hdc/data/Advertise;->time_out:I

    .line 27
    return-void
.end method

.method public setType(Ljava/lang/String;)V
    .locals 0
    .parameter "type"

    .prologue
    .line 32
    iput-object p1, p0, Lcom/hdc/data/Advertise;->type:Ljava/lang/String;

    .line 33
    return-void
.end method

.method public setUrl(Ljava/lang/String;)V
    .locals 0
    .parameter "url"

    .prologue
    .line 38
    iput-object p1, p0, Lcom/hdc/data/Advertise;->url:Ljava/lang/String;

    .line 39
    return-void
.end method
