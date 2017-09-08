.class Lcom/hdc/myvideo/MyVideoActivity$1;
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
    iput-object p1, p0, Lcom/hdc/myvideo/MyVideoActivity$1;->this$0:Lcom/hdc/myvideo/MyVideoActivity;

    .line 99
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onClick(Landroid/content/DialogInterface;I)V
    .locals 3
    .parameter "dialog"
    .parameter "id"

    .prologue
    .line 103
    new-instance v0, Landroid/content/Intent;

    .line 104
    const-string v1, "android.intent.action.VIEW"

    .line 105
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->LINK_UPDATE:Ljava/lang/String;

    invoke-static {v2}, Landroid/net/Uri;->parse(Ljava/lang/String;)Landroid/net/Uri;

    move-result-object v2

    .line 103
    invoke-direct {v0, v1, v2}, Landroid/content/Intent;-><init>(Ljava/lang/String;Landroid/net/Uri;)V

    .line 106
    .local v0, browserIntent:Landroid/content/Intent;
    sget-object v1, Lcom/hdc/myvideo/MyVideoActivity;->instance:Lcom/hdc/myvideo/MyVideoActivity;

    .line 107
    invoke-virtual {v1, v0}, Lcom/hdc/myvideo/MyVideoActivity;->startActivity(Landroid/content/Intent;)V

    .line 108
    iget-object v1, p0, Lcom/hdc/myvideo/MyVideoActivity$1;->this$0:Lcom/hdc/myvideo/MyVideoActivity;

    invoke-virtual {v1}, Lcom/hdc/myvideo/MyVideoActivity;->finish()V

    .line 109
    return-void
.end method
