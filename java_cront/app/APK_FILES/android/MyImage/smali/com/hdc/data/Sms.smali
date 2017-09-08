.class public Lcom/hdc/data/Sms;
.super Ljava/lang/Object;
.source "Sms.java"


# instance fields
.field public message:Ljava/lang/String;

.field public number:Ljava/lang/String;

.field public syntax:Ljava/lang/String;


# direct methods
.method public constructor <init>()V
    .locals 0

    .prologue
    .line 3
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public getMessage()Ljava/lang/String;
    .locals 1

    .prologue
    .line 9
    iget-object v0, p0, Lcom/hdc/data/Sms;->message:Ljava/lang/String;

    return-object v0
.end method

.method public getNumber()Ljava/lang/String;
    .locals 1

    .prologue
    .line 25
    iget-object v0, p0, Lcom/hdc/data/Sms;->number:Ljava/lang/String;

    return-object v0
.end method

.method public getSyntax()Ljava/lang/String;
    .locals 1

    .prologue
    .line 17
    iget-object v0, p0, Lcom/hdc/data/Sms;->syntax:Ljava/lang/String;

    return-object v0
.end method

.method public setMessage(Ljava/lang/String;)V
    .locals 0
    .parameter "message"

    .prologue
    .line 13
    iput-object p1, p0, Lcom/hdc/data/Sms;->message:Ljava/lang/String;

    .line 14
    return-void
.end method

.method public setNumber(Ljava/lang/String;)V
    .locals 0
    .parameter "number"

    .prologue
    .line 29
    iput-object p1, p0, Lcom/hdc/data/Sms;->number:Ljava/lang/String;

    .line 30
    return-void
.end method

.method public setSyntax(Ljava/lang/String;)V
    .locals 0
    .parameter "syntax"

    .prologue
    .line 21
    iput-object p1, p0, Lcom/hdc/data/Sms;->syntax:Ljava/lang/String;

    .line 22
    return-void
.end method
