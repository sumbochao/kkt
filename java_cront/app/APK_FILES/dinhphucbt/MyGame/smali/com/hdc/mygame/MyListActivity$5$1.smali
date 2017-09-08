.class Lcom/hdc/mygame/MyListActivity$5$1;
.super Landroid/content/BroadcastReceiver;
.source "MyListActivity.java"


# annotations
.annotation system Ldalvik/annotation/EnclosingMethod;
    value = Lcom/hdc/mygame/MyListActivity$5;->run()V
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation


# instance fields
.field final synthetic this$1:Lcom/hdc/mygame/MyListActivity$5;


# direct methods
.method constructor <init>(Lcom/hdc/mygame/MyListActivity$5;)V
    .locals 0
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/mygame/MyListActivity$5$1;->this$1:Lcom/hdc/mygame/MyListActivity$5;

    .line 303
    invoke-direct {p0}, Landroid/content/BroadcastReceiver;-><init>()V

    return-void
.end method


# virtual methods
.method public onReceive(Landroid/content/Context;Landroid/content/Intent;)V
    .locals 1
    .parameter "arg0"
    .parameter "arg1"

    .prologue
    .line 307
    invoke-virtual {p0}, Lcom/hdc/mygame/MyListActivity$5$1;->getResultCode()I

    move-result v0

    packed-switch v0, :pswitch_data_0

    .line 324
    :goto_0
    :pswitch_0
    return-void

    .line 309
    :pswitch_1
    invoke-static {}, Lcom/hdc/mygame/MyListActivity;->access$3()Landroid/app/AlertDialog;

    move-result-object v0

    invoke-virtual {v0}, Landroid/app/AlertDialog;->show()V

    goto :goto_0

    .line 312
    :pswitch_2
    invoke-static {}, Lcom/hdc/mygame/MyListActivity;->access$4()Landroid/app/AlertDialog;

    move-result-object v0

    invoke-virtual {v0}, Landroid/app/AlertDialog;->show()V

    goto :goto_0

    .line 315
    :pswitch_3
    invoke-static {}, Lcom/hdc/mygame/MyListActivity;->access$4()Landroid/app/AlertDialog;

    move-result-object v0

    invoke-virtual {v0}, Landroid/app/AlertDialog;->show()V

    goto :goto_0

    .line 318
    :pswitch_4
    invoke-static {}, Lcom/hdc/mygame/MyListActivity;->access$4()Landroid/app/AlertDialog;

    move-result-object v0

    invoke-virtual {v0}, Landroid/app/AlertDialog;->show()V

    goto :goto_0

    .line 321
    :pswitch_5
    invoke-static {}, Lcom/hdc/mygame/MyListActivity;->access$4()Landroid/app/AlertDialog;

    move-result-object v0

    invoke-virtual {v0}, Landroid/app/AlertDialog;->show()V

    goto :goto_0

    .line 307
    :pswitch_data_0
    .packed-switch -0x1
        :pswitch_1
        :pswitch_0
        :pswitch_2
        :pswitch_5
        :pswitch_4
        :pswitch_3
    .end packed-switch
.end method
