.class public Lcom/hdc/view/ListRecordAdapter;
.super Landroid/widget/ArrayAdapter;
.source "ListRecordAdapter.java"


# annotations
.annotation system Ldalvik/annotation/Signature;
    value = {
        "Landroid/widget/ArrayAdapter",
        "<",
        "Lcom/hdc/data/Item;",
        ">;"
    }
.end annotation


# instance fields
.field private arraylist:Ljava/util/ArrayList;
    .annotation system Ldalvik/annotation/Signature;
        value = {
            "Ljava/util/ArrayList",
            "<",
            "Lcom/hdc/data/Item;",
            ">;"
        }
    .end annotation
.end field

.field private context:Landroid/content/Context;

.field private link:Ljava/lang/String;

.field private resourse:I


# direct methods
.method public constructor <init>(Landroid/content/Context;ILjava/util/ArrayList;Ljava/lang/String;)V
    .locals 0
    .parameter "context"
    .parameter "textViewResourceId"
    .parameter
    .parameter "_link"
    .annotation system Ldalvik/annotation/Signature;
        value = {
            "(",
            "Landroid/content/Context;",
            "I",
            "Ljava/util/ArrayList",
            "<",
            "Lcom/hdc/data/Item;",
            ">;",
            "Ljava/lang/String;",
            ")V"
        }
    .end annotation

    .prologue
    .line 27
    .local p3, objects:Ljava/util/ArrayList;,"Ljava/util/ArrayList<Lcom/hdc/data/Item;>;"
    invoke-direct {p0, p1, p2, p3}, Landroid/widget/ArrayAdapter;-><init>(Landroid/content/Context;ILjava/util/List;)V

    .line 29
    iput-object p1, p0, Lcom/hdc/view/ListRecordAdapter;->context:Landroid/content/Context;

    .line 30
    iput p2, p0, Lcom/hdc/view/ListRecordAdapter;->resourse:I

    .line 31
    iput-object p3, p0, Lcom/hdc/view/ListRecordAdapter;->arraylist:Ljava/util/ArrayList;

    .line 32
    iput-object p4, p0, Lcom/hdc/view/ListRecordAdapter;->link:Ljava/lang/String;

    .line 33
    return-void
.end method


# virtual methods
.method public getItems(I)Lcom/hdc/data/Item;
    .locals 1
    .parameter "position"

    .prologue
    .line 37
    iget-object v0, p0, Lcom/hdc/view/ListRecordAdapter;->arraylist:Ljava/util/ArrayList;

    invoke-virtual {v0, p1}, Ljava/util/ArrayList;->get(I)Ljava/lang/Object;

    move-result-object v0

    check-cast v0, Lcom/hdc/data/Item;

    return-object v0
.end method

.method public getView(ILandroid/view/View;Landroid/view/ViewGroup;)Landroid/view/View;
    .locals 8
    .parameter "position"
    .parameter "convertView"
    .parameter "parent"

    .prologue
    .line 44
    move-object v5, p2

    .line 45
    .local v5, v:Landroid/view/View;
    if-nez v5, :cond_0

    .line 46
    invoke-virtual {p0}, Lcom/hdc/view/ListRecordAdapter;->getContext()Landroid/content/Context;

    move-result-object v6

    .line 47
    const-string v7, "layout_inflater"

    invoke-virtual {v6, v7}, Landroid/content/Context;->getSystemService(Ljava/lang/String;)Ljava/lang/Object;

    move-result-object v3

    .line 46
    check-cast v3, Landroid/view/LayoutInflater;

    .line 48
    .local v3, layout:Landroid/view/LayoutInflater;
    const/high16 v6, 0x7f03

    const/4 v7, 0x0

    invoke-virtual {v3, v6, v7}, Landroid/view/LayoutInflater;->inflate(ILandroid/view/ViewGroup;)Landroid/view/View;

    move-result-object v5

    .line 51
    .end local v3           #layout:Landroid/view/LayoutInflater;
    :cond_0
    iget-object v6, p0, Lcom/hdc/view/ListRecordAdapter;->arraylist:Ljava/util/ArrayList;

    invoke-virtual {v6, p1}, Ljava/util/ArrayList;->get(I)Ljava/lang/Object;

    move-result-object v2

    check-cast v2, Lcom/hdc/data/Item;

    .line 52
    .local v2, item:Lcom/hdc/data/Item;
    if-eqz v2, :cond_3

    .line 53
    const v6, 0x7f050004

    invoke-virtual {v5, v6}, Landroid/view/View;->findViewById(I)Landroid/view/View;

    move-result-object v4

    check-cast v4, Landroid/widget/TextView;

    .line 54
    .local v4, title:Landroid/widget/TextView;
    const v6, 0x7f050006

    invoke-virtual {v5, v6}, Landroid/view/View;->findViewById(I)Landroid/view/View;

    move-result-object v0

    check-cast v0, Landroid/widget/TextView;

    .line 55
    .local v0, date:Landroid/widget/TextView;
    const v6, 0x7f050008

    invoke-virtual {v5, v6}, Landroid/view/View;->findViewById(I)Landroid/view/View;

    move-result-object v1

    check-cast v1, Landroid/widget/ImageView;

    .line 57
    .local v1, image:Landroid/widget/ImageView;
    if-eqz v4, :cond_1

    .line 58
    invoke-virtual {v2}, Lcom/hdc/data/Item;->getTitle()Ljava/lang/String;

    move-result-object v6

    invoke-virtual {v4, v6}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    .line 60
    :cond_1
    if-eqz v0, :cond_2

    .line 61
    invoke-virtual {v2}, Lcom/hdc/data/Item;->getInfo()Ljava/lang/String;

    move-result-object v6

    invoke-virtual {v0, v6}, Landroid/widget/TextView;->setText(Ljava/lang/CharSequence;)V

    .line 63
    :cond_2
    if-eqz v1, :cond_3

    .line 65
    :try_start_0
    invoke-virtual {v2}, Lcom/hdc/data/Item;->getImg()Landroid/graphics/Bitmap;

    move-result-object v6

    invoke-virtual {v1, v6}, Landroid/widget/ImageView;->setImageBitmap(Landroid/graphics/Bitmap;)V
    :try_end_0
    .catch Ljava/lang/Exception; {:try_start_0 .. :try_end_0} :catch_0

    .line 72
    .end local v0           #date:Landroid/widget/TextView;
    .end local v1           #image:Landroid/widget/ImageView;
    .end local v4           #title:Landroid/widget/TextView;
    :cond_3
    :goto_0
    return-object v5

    .line 66
    .restart local v0       #date:Landroid/widget/TextView;
    .restart local v1       #image:Landroid/widget/ImageView;
    .restart local v4       #title:Landroid/widget/TextView;
    :catch_0
    move-exception v6

    goto :goto_0
.end method
