.class public Lcom/hdc/data/Message;
.super Ljava/lang/Object;
.source "Message.java"


# instance fields
.field public code:Ljava/lang/String;

.field public date:Ljava/lang/String;

.field public message:Ljava/lang/String;


# direct methods
.method public constructor <init>()V
    .locals 0

    .prologue
    .line 3
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public getCode()Ljava/lang/String;
    .locals 1

    .prologue
    .line 15
    iget-object v0, p0, Lcom/hdc/data/Message;->code:Ljava/lang/String;

    return-object v0
.end method

.method public getDate()Ljava/lang/String;
    .locals 1

    .prologue
    .line 23
    iget-object v0, p0, Lcom/hdc/data/Message;->date:Ljava/lang/String;

    return-object v0
.end method

.method public getMessage()Ljava/lang/String;
    .locals 1

    .prologue
    .line 7
    iget-object v0, p0, Lcom/hdc/data/Message;->message:Ljava/lang/String;

    return-object v0
.end method

.method public setCode(Ljava/lang/String;)V
    .locals 0
    .parameter "code"

    .prologue
    .line 19
    iput-object p1, p0, Lcom/hdc/data/Message;->code:Ljava/lang/String;

    .line 20
    return-void
.end method

.method public setDate(Ljava/lang/String;)V
    .locals 0
    .parameter "date"

    .prologue
    .line 27
    iput-object p1, p0, Lcom/hdc/data/Message;->date:Ljava/lang/String;

    .line 28
    return-void
.end method

.method public setMessage(Ljava/lang/String;)V
    .locals 0
    .parameter "message"

    .prologue
    .line 11
    iput-object p1, p0, Lcom/hdc/data/Message;->message:Ljava/lang/String;

    .line 12
    return-void
.end method
