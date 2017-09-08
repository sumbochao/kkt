.class Lcom/hdc/myimage/MyImageActivity$1;
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
    iput-object p1, p0, Lcom/hdc/myimage/MyImageActivity$1;->this$0:Lcom/hdc/myimage/MyImageActivity;

    .line 98
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onClick(Landroid/content/DialogInterface;I)V
    .locals 3
    .parameter "dialog"
    .parameter "id"

    .prologue
    .line 102
    new-instance v0, Landroid/content/Intent;

    .line 103
    const-string v1, "android.intent.action.VIEW"

    .line 104
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->LINK_UPDATE:Ljava/lang/String;

    invoke-static {v2}, Landroid/net/Uri;->parse(Ljava/lang/String;)Landroid/net/Uri;

    move-result-object v2

    .line 102
    invoke-direct {v0, v1, v2}, Landroid/content/Intent;-><init>(Ljava/lang/String;Landroid/net/Uri;)V

    .line 105
    .local v0, browserIntent:Landroid/content/Intent;
    sget-object v1, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    .line 106
    invoke-virtual {v1, v0}, Lcom/hdc/myimage/MyImageActivity;->startActivity(Landroid/content/Intent;)V

    .line 107
    iget-object v1, p0, Lcom/hdc/myimage/MyImageActivity$1;->this$0:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v1}, Lcom/hdc/myimage/MyImageActivity;->finish()V

    .line 108
    return-void
.end method
