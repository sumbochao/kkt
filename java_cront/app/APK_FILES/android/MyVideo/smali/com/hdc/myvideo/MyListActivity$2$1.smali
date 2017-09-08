.class Lcom/hdc/myvideo/MyListActivity$2$1;
.super Ljava/lang/Object;
.source "MyListActivity.java"

# interfaces
.implements Landroid/content/DialogInterface$OnClickListener;


# annotations
.annotation system Ldalvik/annotation/EnclosingMethod;
    value = Lcom/hdc/myvideo/MyListActivity$2;->onItemClick(Landroid/widget/AdapterView;Landroid/view/View;IJ)V
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation


# instance fields
.field final synthetic this$1:Lcom/hdc/myvideo/MyListActivity$2;

.field private final synthetic val$m_position:I


# direct methods
.method constructor <init>(Lcom/hdc/myvideo/MyListActivity$2;I)V
    .locals 0
    .parameter
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/myvideo/MyListActivity$2$1;->this$1:Lcom/hdc/myvideo/MyListActivity$2;

    iput p2, p0, Lcom/hdc/myvideo/MyListActivity$2$1;->val$m_position:I

    .line 174
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onClick(Landroid/content/DialogInterface;I)V
    .locals 4
    .parameter "dialog"
    .parameter "id"

    .prologue
    .line 178
    new-instance v1, Ljava/lang/StringBuilder;

    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->m_Sms:Lcom/hdc/data/Sms;

    .line 179
    invoke-virtual {v2}, Lcom/hdc/data/Sms;->getSyntax()Ljava/lang/String;

    move-result-object v2

    invoke-static {v2}, Ljava/lang/String;->valueOf(Ljava/lang/Object;)Ljava/lang/String;

    move-result-object v2

    invoke-direct {v1, v2}, Ljava/lang/StringBuilder;-><init>(Ljava/lang/String;)V

    .line 180
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->SPACE:Ljava/lang/String;

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    .line 181
    invoke-static {}, Lcom/hdc/myvideo/MyListActivity;->access$1()Lcom/hdc/view/ListRecordAdapter;

    move-result-object v2

    .line 182
    iget v3, p0, Lcom/hdc/myvideo/MyListActivity$2$1;->val$m_position:I

    .line 181
    invoke-virtual {v2, v3}, Lcom/hdc/view/ListRecordAdapter;->getItems(I)Lcom/hdc/data/Item;

    move-result-object v2

    .line 182
    invoke-virtual {v2}, Lcom/hdc/data/Item;->getId()Ljava/lang/String;

    move-result-object v2

    .line 181
    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    .line 183
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->SPACE:Ljava/lang/String;

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    .line 184
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->m_UserID:Ljava/lang/String;

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    .line 185
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->SPACE:Ljava/lang/String;

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    .line 186
    sget-object v2, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v2, v2, Lcom/hdc/ultilities/ConnectServer;->REF_CODE:Ljava/lang/String;

    invoke-virtual {v1, v2}, Ljava/lang/StringBuilder;->append(Ljava/lang/String;)Ljava/lang/StringBuilder;

    move-result-object v1

    .line 178
    invoke-virtual {v1}, Ljava/lang/StringBuilder;->toString()Ljava/lang/String;

    move-result-object v0

    .line 189
    .local v0, sms:Ljava/lang/String;
    sget-object v1, Lcom/hdc/ultilities/ConnectServer;->instance:Lcom/hdc/ultilities/ConnectServer;

    iget-object v1, v1, Lcom/hdc/ultilities/ConnectServer;->m_Sms:Lcom/hdc/data/Sms;

    .line 190
    invoke-virtual {v1}, Lcom/hdc/data/Sms;->getNumber()Ljava/lang/String;

    move-result-object v1

    .line 188
    invoke-static {v0, v1}, Lcom/hdc/myvideo/MyListActivity;->sendSMS(Ljava/lang/String;Ljava/lang/String;)V

    .line 191
    return-void
.end method
