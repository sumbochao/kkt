.class Lcom/hdc/myvideo/MyVideoActivity$2;
.super Ljava/lang/Object;
.source "MyVideoActivity.java"

# interfaces
.implements Landroid/content/DialogInterface$OnClickListener;


# annotations
.annotation system Ldalvik/annotation/EnclosingMethod;
    value = Lcom/hdc/myvideo/MyVideoActivity;->onCreate(Landroid/os/Bundle;)V
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation


# instance fields
.field final synthetic this$0:Lcom/hdc/myvideo/MyVideoActivity;


# direct methods
.method constructor <init>(Lcom/hdc/myvideo/MyVideoActivity;)V
    .locals 0
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/myvideo/MyVideoActivity$2;->this$0:Lcom/hdc/myvideo/MyVideoActivity;

    .line 112
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onClick(Landroid/content/DialogInterface;I)V
    .locals 3
    .parameter "dialog"
    .parameter "id"

    .prologue
    .line 115
    invoke-interface {p1}, Landroid/content/DialogInterface;->cancel()V

    .line 117
    new-instance v0, Landroid/content/Intent;

    iget-object v1, p0, Lcom/hdc/myvideo/MyVideoActivity$2;->this$0:Lcom/hdc/myvideo/MyVideoActivity;

    .line 118
    const-class v2, Lcom/hdc/myvideo/MyListActivity;

    .line 117
    invoke-direct {v0, v1, v2}, Landroid/content/Intent;-><init>(Landroid/content/Context;Ljava/lang/Class;)V

    .line 119
    .local v0, mIntent:Landroid/content/Intent;
    iget-object v1, p0, Lcom/hdc/myvideo/MyVideoActivity$2;->this$0:Lcom/hdc/myvideo/MyVideoActivity;

    invoke-virtual {v1, v0}, Lcom/hdc/myvideo/MyVideoActivity;->startActivity(Landroid/content/Intent;)V

    .line 120
    iget-object v1, p0, Lcom/hdc/myvideo/MyVideoActivity$2;->this$0:Lcom/hdc/myvideo/MyVideoActivity;

    invoke-virtual {v1}, Lcom/hdc/myvideo/MyVideoActivity;->finish()V

    .line 121
    return-void
.end method
