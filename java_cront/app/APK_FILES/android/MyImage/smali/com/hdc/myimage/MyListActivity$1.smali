.class Lcom/hdc/myimage/MyListActivity$1;
.super Landroid/os/Handler;
.source "MyListActivity.java"


# annotations
.annotation system Ldalvik/annotation/EnclosingClass;
    value = Lcom/hdc/myimage/MyListActivity;
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation


# instance fields
.field final synthetic this$0:Lcom/hdc/myimage/MyListActivity;


# direct methods
.method constructor <init>(Lcom/hdc/myimage/MyListActivity;)V
    .locals 0
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/myimage/MyListActivity$1;->this$0:Lcom/hdc/myimage/MyListActivity;

    .line 362
    invoke-direct {p0}, Landroid/os/Handler;-><init>()V

    return-void
.end method


# virtual methods
.method public handleMessage(Landroid/os/Message;)V
    .locals 2
    .parameter "msg"

    .prologue
    .line 364
    iget-object v0, p0, Lcom/hdc/myimage/MyListActivity$1;->this$0:Lcom/hdc/myimage/MyListActivity;

    #getter for: Lcom/hdc/myimage/MyListActivity;->imgAds:Landroid/widget/ImageView;
    invoke-static {v0}, Lcom/hdc/myimage/MyListActivity;->access$0(Lcom/hdc/myimage/MyListActivity;)Landroid/widget/ImageView;

    move-result-object v0

    const/16 v1, 0x8

    invoke-virtual {v0, v1}, Landroid/widget/ImageView;->setVisibility(I)V

    .line 365
    return-void
.end method
