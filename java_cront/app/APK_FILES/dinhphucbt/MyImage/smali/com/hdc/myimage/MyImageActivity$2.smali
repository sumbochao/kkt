.class Lcom/hdc/myimage/MyImageActivity$2;
.super Ljava/lang/Object;
.source "MyImageActivity.java"

# interfaces
.implements Landroid/content/DialogInterface$OnClickListener;


# annotations
.annotation system Ldalvik/annotation/EnclosingMethod;
    value = Lcom/hdc/myimage/MyImageActivity;->onCreate(Landroid/os/Bundle;)V
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation


# instance fields
.field final synthetic this$0:Lcom/hdc/myimage/MyImageActivity;


# direct methods
.method constructor <init>(Lcom/hdc/myimage/MyImageActivity;)V
    .locals 0
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/myimage/MyImageActivity$2;->this$0:Lcom/hdc/myimage/MyImageActivity;

    .line 111
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onClick(Landroid/content/DialogInterface;I)V
    .locals 3
    .parameter "dialog"
    .parameter "id"

    .prologue
    .line 114
    invoke-interface {p1}, Landroid/content/DialogInterface;->cancel()V

    .line 116
    new-instance v0, Landroid/content/Intent;

    iget-object v1, p0, Lcom/hdc/myimage/MyImageActivity$2;->this$0:Lcom/hdc/myimage/MyImageActivity;

    .line 117
    const-class v2, Lcom/hdc/myimage/MyListActivity;

    .line 116
    invoke-direct {v0, v1, v2}, Landroid/content/Intent;-><init>(Landroid/content/Context;Ljava/lang/Class;)V

    .line 118
    .local v0, mIntent:Landroid/content/Intent;
    iget-object v1, p0, Lcom/hdc/myimage/MyImageActivity$2;->this$0:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v1, v0}, Lcom/hdc/myimage/MyImageActivity;->startActivity(Landroid/content/Intent;)V

    .line 119
    iget-object v1, p0, Lcom/hdc/myimage/MyImageActivity$2;->this$0:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v1}, Lcom/hdc/myimage/MyImageActivity;->finish()V

    .line 120
    return-void
.end method
