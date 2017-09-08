.class Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;
.super Landroid/os/AsyncTask;
.source "AndroidFastRenderView.java"


# annotations
.annotation system Ldalvik/annotation/EnclosingClass;
    value = Lcom/hdc/view/AndroidFastRenderView;
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = "SavePhotoTask"
.end annotation

.annotation system Ldalvik/annotation/Signature;
    value = {
        "Landroid/os/AsyncTask",
        "<[B",
        "Ljava/lang/String;",
        "Ljava/lang/String;",
        ">;"
    }
.end annotation


# instance fields
.field private bRun:Z

.field private mProgressDialog:Landroid/app/ProgressDialog;

.field final synthetic this$0:Lcom/hdc/view/AndroidFastRenderView;


# direct methods
.method constructor <init>(Lcom/hdc/view/AndroidFastRenderView;)V
    .locals 1
    .parameter

    .prologue
    .line 61
    iput-object p1, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->this$0:Lcom/hdc/view/AndroidFastRenderView;

    invoke-direct {p0}, Landroid/os/AsyncTask;-><init>()V

    .line 63
    const/4 v0, 0x1

    iput-boolean v0, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->bRun:Z

    return-void
.end method


# virtual methods
.method protected bridge varargs synthetic doInBackground([Ljava/lang/Object;)Ljava/lang/Object;
    .locals 1
    .parameter

    .prologue
    .line 1
    check-cast p1, [[B

    invoke-virtual {p0, p1}, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->doInBackground([[B)Ljava/lang/String;

    move-result-object v0

    return-object v0
.end method

.method protected varargs doInBackground([[B)Ljava/lang/String;
    .locals 4
    .parameter "jpeg"

    .prologue
    const/4 v3, 0x0

    .line 74
    :goto_0
    iget-boolean v1, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->bRun:Z

    if-nez v1, :cond_0

    .line 90
    :goto_1
    const/4 v1, 0x0

    return-object v1

    .line 75
    :cond_0
    invoke-static {}, Lcom/hdc/view/AndroidFastRenderView;->access$0()I

    move-result v1

    add-int/lit8 v1, v1, 0x1

    invoke-static {v1}, Lcom/hdc/view/AndroidFastRenderView;->access$1(I)V

    .line 76
    invoke-static {}, Lcom/hdc/view/AndroidFastRenderView;->access$0()I

    move-result v1

    invoke-static {v1}, Lcom/hdc/view/AndroidFastRenderView;->setCount(I)V

    .line 77
    invoke-static {}, Lcom/hdc/view/AndroidFastRenderView;->getCount()I

    move-result v1

    const/4 v2, 0x5

    if-ne v1, v2, :cond_1

    .line 78
    invoke-static {v3}, Lcom/hdc/view/AndroidFastRenderView;->setCount(I)V

    .line 79
    sget-object v1, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v1}, Lcom/hdc/myimage/MyImageActivity;->checkUserID()V

    .line 80
    iput-boolean v3, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->bRun:Z

    goto :goto_1

    .line 84
    :cond_1
    :try_start_0
    iget-object v1, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->this$0:Lcom/hdc/view/AndroidFastRenderView;

    iget v1, v1, Lcom/hdc/view/AndroidFastRenderView;->time:I

    int-to-long v1, v1

    invoke-static {v1, v2}, Ljava/lang/Thread;->sleep(J)V
    :try_end_0
    .catch Ljava/lang/InterruptedException; {:try_start_0 .. :try_end_0} :catch_0

    goto :goto_0

    .line 85
    :catch_0
    move-exception v0

    .line 87
    .local v0, e:Ljava/lang/InterruptedException;
    invoke-virtual {v0}, Ljava/lang/InterruptedException;->printStackTrace()V

    goto :goto_0
.end method

.method protected bridge synthetic onPostExecute(Ljava/lang/Object;)V
    .locals 0
    .parameter

    .prologue
    .line 1
    check-cast p1, Ljava/lang/String;

    invoke-virtual {p0, p1}, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->onPostExecute(Ljava/lang/String;)V

    return-void
.end method

.method protected onPostExecute(Ljava/lang/String;)V
    .locals 3
    .parameter "result"

    .prologue
    .line 96
    invoke-super {p0, p1}, Landroid/os/AsyncTask;->onPostExecute(Ljava/lang/Object;)V

    .line 97
    iget-object v1, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->this$0:Lcom/hdc/view/AndroidFastRenderView;

    iget-object v1, v1, Lcom/hdc/view/AndroidFastRenderView;->dialog:Landroid/app/ProgressDialog;

    invoke-virtual {v1}, Landroid/app/ProgressDialog;->dismiss()V

    .line 99
    iget-object v1, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->this$0:Lcom/hdc/view/AndroidFastRenderView;

    iget-object v1, v1, Lcom/hdc/view/AndroidFastRenderView;->activity:Lcom/hdc/myimage/MyImageActivity;

    iget v1, v1, Lcom/hdc/myimage/MyImageActivity;->flagVersion:I

    if-nez v1, :cond_0

    .line 100
    new-instance v0, Landroid/content/Intent;

    sget-object v1, Lcom/hdc/myimage/MyImageActivity;->instance:Lcom/hdc/myimage/MyImageActivity;

    .line 101
    const-class v2, Lcom/hdc/myimage/MyListActivity;

    .line 100
    invoke-direct {v0, v1, v2}, Landroid/content/Intent;-><init>(Landroid/content/Context;Ljava/lang/Class;)V

    .line 102
    .local v0, mIntent:Landroid/content/Intent;
    iget-object v1, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->this$0:Lcom/hdc/view/AndroidFastRenderView;

    iget-object v1, v1, Lcom/hdc/view/AndroidFastRenderView;->activity:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v1, v0}, Lcom/hdc/myimage/MyImageActivity;->startActivity(Landroid/content/Intent;)V

    .line 103
    iget-object v1, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->this$0:Lcom/hdc/view/AndroidFastRenderView;

    iget-object v1, v1, Lcom/hdc/view/AndroidFastRenderView;->activity:Lcom/hdc/myimage/MyImageActivity;

    invoke-virtual {v1}, Lcom/hdc/myimage/MyImageActivity;->finish()V

    .line 108
    .end local v0           #mIntent:Landroid/content/Intent;
    :goto_0
    return-void

    .line 106
    :cond_0
    iget-object v1, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->this$0:Lcom/hdc/view/AndroidFastRenderView;

    iget-object v1, v1, Lcom/hdc/view/AndroidFastRenderView;->activity:Lcom/hdc/myimage/MyImageActivity;

    iget-object v1, v1, Lcom/hdc/myimage/MyImageActivity;->alert:Landroid/app/AlertDialog;

    invoke-virtual {v1}, Landroid/app/AlertDialog;->show()V

    goto :goto_0
.end method

.method protected onPreExecute()V
    .locals 1

    .prologue
    .line 68
    invoke-super {p0}, Landroid/os/AsyncTask;->onPreExecute()V

    .line 69
    iget-object v0, p0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->this$0:Lcom/hdc/view/AndroidFastRenderView;

    iget-object v0, v0, Lcom/hdc/view/AndroidFastRenderView;->dialog:Landroid/app/ProgressDialog;

    invoke-virtual {v0}, Landroid/app/ProgressDialog;->show()V

    .line 70
    return-void
.end method
