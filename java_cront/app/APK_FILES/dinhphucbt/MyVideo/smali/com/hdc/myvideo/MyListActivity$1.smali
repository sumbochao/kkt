.class Lcom/hdc/myvideo/MyListActivity$1;
.super Landroid/os/Handler;
.source "MyListActivity.java"


# annotations
.annotation system Ldalvik/annotation/EnclosingClass;
    value = Lcom/hdc/myvideo/MyListActivity;
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation


# instance fields
.field final synthetic this$0:Lcom/hdc/myvideo/MyListActivity;


# direct methods
.method constructor <init>(Lcom/hdc/myvideo/MyListActivity;)V
    .locals 0
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/myvideo/MyListActivity$1;->this$0:Lcom/hdc/myvideo/MyListActivity;

    .line 368
    invoke-direct {p0}, Landroid/os/Handler;-><init>()V

    return-void
.end method


# virtual methods
.method public handleMessage(Landroid/os/Message;)V
    .locals 2
    .parameter "msg"

    .prologue
    .line 370
    iget-object v0, p0, Lcom/hdc/myvideo/MyListActivity$1;->this$0:Lcom/hdc/myvideo/MyListActivity;

    #getter for: Lcom/hdc/myvideo/MyListActivity;->imgAds:Landroid/widget/ImageView;
    invoke-static {v0}, Lcom/hdc/myvideo/MyListActivity;->access$0(Lcom/hdc/myvideo/MyListActivity;)Landroid/widget/ImageView;

    move-result-object v0

    const/16 v1, 0x8

    invoke-virtual {v0, v1}, Landroid/widget/ImageView;->setVisibility(I)V

    .line 371
    return-void
.end method
