.class Lcom/hdc/mygame/MyListActivity$4;
.super Ljava/lang/Object;
.source "MyListActivity.java"

# interfaces
.implements Landroid/view/View$OnClickListener;


# annotations
.annotation system Ldalvik/annotation/EnclosingMethod;
    value = Lcom/hdc/mygame/MyListActivity;->initRelativeLayout_Advertise()V
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation


# instance fields
.field final synthetic this$0:Lcom/hdc/mygame/MyListActivity;


# direct methods
.method constructor <init>(Lcom/hdc/mygame/MyListActivity;)V
    .locals 0
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/mygame/MyListActivity$4;->this$0:Lcom/hdc/mygame/MyListActivity;

    .line 231
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onClick(Landroid/view/View;)V
    .locals 3
    .parameter "v"

    .prologue
    .line 236
    new-instance v0, Landroid/content/Intent;

    const-string v1, "android.intent.action.VIEW"

    .line 237
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->m_Advertise:Lcom/hdc/data/Advertise;

    invoke-virtual {v2}, Lcom/hdc/data/Advertise;->getUrl()Ljava/lang/String;

    move-result-object v2

    invoke-static {v2}, Landroid/net/Uri;->parse(Ljava/lang/String;)Landroid/net/Uri;

    move-result-object v2

    .line 236
    invoke-direct {v0, v1, v2}, Landroid/content/Intent;-><init>(Ljava/lang/String;Landroid/net/Uri;)V

    .line 238
    .local v0, browserIntent:Landroid/content/Intent;
    invoke-static {}, Lcom/hdc/mygame/MyListActivity;->access$2()Lcom/hdc/mygame/MyListActivity;

    move-result-object v1

    invoke-virtual {v1, v0}, Lcom/hdc/mygame/MyListActivity;->startActivity(Landroid/content/Intent;)V

    .line 239
    iget-object v1, p0, Lcom/hdc/mygame/MyListActivity$4;->this$0:Lcom/hdc/mygame/MyListActivity;

    invoke-virtual {v1}, Lcom/hdc/mygame/MyListActivity;->finish()V

    .line 240
    return-void
.end method
