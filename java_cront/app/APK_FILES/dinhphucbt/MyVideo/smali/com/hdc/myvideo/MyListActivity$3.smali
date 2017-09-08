.class Lcom/hdc/myvideo/MyListActivity$3;
.super Ljava/lang/Object;
.source "MyListActivity.java"

# interfaces
.implements Landroid/content/DialogInterface$OnClickListener;


# annotations
.annotation system Ldalvik/annotation/EnclosingMethod;
    value = Lcom/hdc/myvideo/MyListActivity;->initAlertDialog_Success_Fail()V
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
    iput-object p1, p0, Lcom/hdc/myvideo/MyListActivity$3;->this$0:Lcom/hdc/myvideo/MyListActivity;

    .line 214
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onClick(Landroid/content/DialogInterface;I)V
    .locals 0
    .parameter "dialog"
    .parameter "id"

    .prologue
    .line 216
    invoke-interface {p1}, Landroid/content/DialogInterface;->cancel()V

    .line 217
    return-void
.end method
