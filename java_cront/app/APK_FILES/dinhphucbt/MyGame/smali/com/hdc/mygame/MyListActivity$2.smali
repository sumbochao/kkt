.class Lcom/hdc/mygame/MyListActivity$2;
.super Ljava/lang/Object;
.source "MyListActivity.java"

# interfaces
.implements Landroid/widget/AdapterView$OnItemClickListener;


# annotations
.annotation system Ldalvik/annotation/EnclosingMethod;
    value = Lcom/hdc/mygame/MyListActivity;->initListView()V
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation

.annotation system Ldalvik/annotation/Signature;
    value = {
        "Ljava/lang/Object;",
        "Landroid/widget/AdapterView$OnItemClickListener;"
    }
.end annotation


# instance fields
.field final synthetic this$0:Lcom/hdc/mygame/MyListActivity;


# direct methods
.method constructor <init>(Lcom/hdc/mygame/MyListActivity;)V
    .locals 0
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/mygame/MyListActivity$2;->this$0:Lcom/hdc/mygame/MyListActivity;

    .line 150
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public onItemClick(Landroid/widget/AdapterView;Landroid/view/View;IJ)V
    .locals 6
    .parameter
    .parameter "v"
    .parameter "position"
    .parameter "id"
    .annotation system Ldalvik/annotation/Signature;
        value = {
            "(",
            "Landroid/widget/AdapterView",
            "<*>;",
            "Landroid/view/View;",
            "IJ)V"
        }
    .end annotation

    .prologue
    .line 155
    .local p1, arg0:Landroid/widget/AdapterView;,"Landroid/widget/AdapterView<*>;"
    move v2, p3

    .line 157
    .local v2, m_position:I
    new-instance v1, Landroid/app/AlertDialog$Builder;

    .line 158
    iget-object v3, p0, Lcom/hdc/mygame/MyListActivity$2;->this$0:Lcom/hdc/mygame/MyListActivity;

    .line 157
    invoke-direct {v1, v3}, Landroid/app/AlertDialog$Builder;-><init>(Landroid/content/Context;)V

    .line 160
    .local v1, builder:Landroid/app/AlertDialog$Builder;
    const-string v3, "B\u1ea1n c\u00f3 mu\u1ed1n nh\u1eafn tin \n \u0111\u1ec3 t\u1ea3i game n\u00e0y v\u1ec1 kh\u00f4ng ?"

    .line 159
    invoke-virtual {v1, v3}, Landroid/app/AlertDialog$Builder;->setMessage(Ljava/lang/CharSequence;)Landroid/app/AlertDialog$Builder;

    move-result-object v3

    .line 161
    const/4 v4, 0x0

    invoke-virtual {v3, v4}, Landroid/app/AlertDialog$Builder;->setCancelable(Z)Landroid/app/AlertDialog$Builder;

    move-result-object v3

    .line 162
    const-string v4, "Yes"

    .line 163
    new-instance v5, Lcom/hdc/mygame/MyListActivity$2$1;

    invoke-direct {v5, p0, v2}, Lcom/hdc/mygame/MyListActivity$2$1;-><init>(Lcom/hdc/mygame/MyListActivity$2;I)V

    .line 162
    invoke-virtual {v3, v4, v5}, Landroid/app/AlertDialog$Builder;->setPositiveButton(Ljava/lang/CharSequence;Landroid/content/DialogInterface$OnClickListener;)Landroid/app/AlertDialog$Builder;

    move-result-object v3

    .line 182
    const-string v4, "No"

    .line 183
    new-instance v5, Lcom/hdc/mygame/MyListActivity$2$2;

    invoke-direct {v5, p0}, Lcom/hdc/mygame/MyListActivity$2$2;-><init>(Lcom/hdc/mygame/MyListActivity$2;)V

    .line 182
    invoke-virtual {v3, v4, v5}, Landroid/app/AlertDialog$Builder;->setNegativeButton(Ljava/lang/CharSequence;Landroid/content/DialogInterface$OnClickListener;)Landroid/app/AlertDialog$Builder;

    .line 189
    invoke-virtual {v1}, Landroid/app/AlertDialog$Builder;->create()Landroid/app/AlertDialog;

    move-result-object v0

    .line 190
    .local v0, alert:Landroid/app/AlertDialog;
    invoke-virtual {v0}, Landroid/app/AlertDialog;->show()V

    .line 191
    return-void
.end method
