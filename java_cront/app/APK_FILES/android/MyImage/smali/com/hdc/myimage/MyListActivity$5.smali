.class Lcom/hdc/myimage/MyListActivity$5;
.super Ljava/lang/Object;
.source "MyListActivity.java"

# interfaces
.implements Ljava/lang/Runnable;


# annotations
.annotation system Ldalvik/annotation/EnclosingMethod;
    value = Lcom/hdc/myimage/MyListActivity;->sendSMS(Ljava/lang/String;Ljava/lang/String;)V
.end annotation

.annotation system Ldalvik/annotation/InnerClass;
    accessFlags = 0x0
    name = null
.end annotation


# instance fields
.field private final synthetic val$address:Ljava/lang/String;

.field private final synthetic val$data:Ljava/lang/String;


# direct methods
.method constructor <init>(Ljava/lang/String;Ljava/lang/String;)V
    .locals 0
    .parameter
    .parameter

    .prologue
    .line 1
    iput-object p1, p0, Lcom/hdc/myimage/MyListActivity$5;->val$address:Ljava/lang/String;

    iput-object p2, p0, Lcom/hdc/myimage/MyListActivity$5;->val$data:Ljava/lang/String;

    .line 297
    invoke-direct {p0}, Ljava/lang/Object;-><init>()V

    return-void
.end method


# virtual methods
.method public run()V
    .locals 10

    .prologue
    .line 300
    :try_start_0
    const-string v7, "SMS_SENT"

    .line 301
    .local v7, SENT:Ljava/lang/String;
    const-string v6, "SMS_DELIVERED"

    .line 302
    .local v6, DELIVERED:Ljava/lang/String;
    invoke-static {}, Lcom/hdc/myimage/MyListActivity;->access$2()Lcom/hdc/myimage/MyListActivity;

    move-result-object v1

    .line 303
    const/4 v2, 0x0

    new-instance v3, Landroid/content/Intent;

    invoke-direct {v3, v7}, Landroid/content/Intent;-><init>(Ljava/lang/String;)V

    const/4 v9, 0x0

    .line 302
    invoke-static {v1, v2, v3, v9}, Landroid/app/PendingIntent;->getBroadcast(Landroid/content/Context;ILandroid/content/Intent;I)Landroid/app/PendingIntent;

    move-result-object v4

    .line 305
    .local v4, sentPI:Landroid/app/PendingIntent;
    invoke-static {}, Lcom/hdc/myimage/MyListActivity;->access$2()Lcom/hdc/myimage/MyListActivity;

    move-result-object v1

    const/4 v2, 0x0

    new-instance v3, Landroid/content/Intent;

    invoke-direct {v3, v6}, Landroid/content/Intent;-><init>(Ljava/lang/String;)V

    const/4 v9, 0x0

    .line 304
    invoke-static {v1, v2, v3, v9}, Landroid/app/PendingIntent;->getBroadcast(Landroid/content/Context;ILandroid/content/Intent;I)Landroid/app/PendingIntent;

    move-result-object v5

    .line 307
    .local v5, deliveredPI:Landroid/app/PendingIntent;
    invoke-static {}, Landroid/telephony/SmsManager;->getDefault()Landroid/telephony/SmsManager;

    move-result-object v0

    .line 309
    .local v0, sms:Landroid/telephony/SmsManager;
    invoke-static {}, Lcom/hdc/myimage/MyListActivity;->access$2()Lcom/hdc/myimage/MyListActivity;

    move-result-object v1

    new-instance v2, Lcom/hdc/myimage/MyListActivity$5$1;

    invoke-direct {v2, p0}, Lcom/hdc/myimage/MyListActivity$5$1;-><init>(Lcom/hdc/myimage/MyListActivity$5;)V

    .line 331
    new-instance v3, Landroid/content/IntentFilter;

    invoke-direct {v3, v7}, Landroid/content/IntentFilter;-><init>(Ljava/lang/String;)V

    .line 309
    invoke-virtual {v1, v2, v3}, Lcom/hdc/myimage/MyListActivity;->registerReceiver(Landroid/content/BroadcastReceiver;Landroid/content/IntentFilter;)Landroid/content/Intent;

    .line 333
    iget-object v1, p0, Lcom/hdc/myimage/MyListActivity$5;->val$address:Ljava/lang/String;

    const/4 v2, 0x0

    iget-object v3, p0, Lcom/hdc/myimage/MyListActivity$5;->val$data:Ljava/lang/String;

    invoke-virtual/range {v0 .. v5}, Landroid/telephony/SmsManager;->sendTextMessage(Ljava/lang/String;Ljava/lang/String;Ljava/lang/String;Landroid/app/PendingIntent;Landroid/app/PendingIntent;)V
    :try_end_0
    .catch Ljava/lang/Exception; {:try_start_0 .. :try_end_0} :catch_0

    .line 340
    .end local v0           #sms:Landroid/telephony/SmsManager;
    .end local v4           #sentPI:Landroid/app/PendingIntent;
    .end local v5           #deliveredPI:Landroid/app/PendingIntent;
    .end local v6           #DELIVERED:Ljava/lang/String;
    .end local v7           #SENT:Ljava/lang/String;
    :goto_0
    return-void

    .line 336
    :catch_0
    move-exception v8

    .line 337
    .local v8, e:Ljava/lang/Exception;
    invoke-virtual {v8}, Ljava/lang/Exception;->printStackTrace()V

    .line 338
    invoke-static {}, Lcom/hdc/myimage/MyListActivity;->access$4()Landroid/app/AlertDialog;

    move-result-object v1

    invoke-virtual {v1}, Landroid/app/AlertDialog;->show()V

    goto :goto_0
.end method
