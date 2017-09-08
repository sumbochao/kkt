.class public Lcom/hdc/view/AndroidFastRenderView;
.super Landroid/view/SurfaceView;
.source "AndroidFastRenderView.java"

# interfaces
.implements Ljava/lang/Runnable;


# annotations
.annotation system Ldalvik/annotation/MemberClasses;
    value = {
        Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;
    }
.end annotation


# static fields
.field private static count:I


# instance fields
.field final activity:Lcom/hdc/mygame/MyGameActivity;

.field dialog:Landroid/app/ProgressDialog;

.field framebuffer:Landroid/graphics/Bitmap;

.field holder:Landroid/view/SurfaceHolder;

.field paint:Landroid/graphics/Paint;

.field renderThread:Ljava/lang/Thread;

.field volatile running:Z

.field s:Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;

.field time:I


# direct methods
.method static constructor <clinit>()V
    .locals 1

    .prologue
    .line 26
    const/4 v0, 0x0

    sput v0, Lcom/hdc/view/AndroidFastRenderView;->count:I

    .line 17
    return-void
.end method

.method public constructor <init>(Lcom/hdc/mygame/MyGameActivity;Landroid/graphics/Bitmap;)V
    .locals 2
    .parameter "m_activity"
    .parameter "framebuffer"

    .prologue
    .line 38
    invoke-direct {p0, p1}, Landroid/view/SurfaceView;-><init>(Landroid/content/Context;)V

    .line 20
    const/4 v0, 0x0

    iput-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->renderThread:Ljava/lang/Thread;

    .line 22
    const/4 v0, 0x0

    iput-boolean v0, p0, Lcom/hdc/view/AndroidFastRenderView;->running:Z

    .line 24
    const/16 v0, 0xa

    iput v0, p0, Lcom/hdc/view/AndroidFastRenderView;->time:I

    .line 27
    new-instance v0, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;

    invoke-direct {v0, p0}, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;-><init>(Lcom/hdc/view/AndroidFastRenderView;)V

    iput-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->s:Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;

    .line 39
    iput-object p1, p0, Lcom/hdc/view/AndroidFastRenderView;->activity:Lcom/hdc/mygame/MyGameActivity;

    .line 40
    iput-object p2, p0, Lcom/hdc/view/AndroidFastRenderView;->framebuffer:Landroid/graphics/Bitmap;

    .line 41
    invoke-virtual {p0}, Lcom/hdc/view/AndroidFastRenderView;->getHolder()Landroid/view/SurfaceHolder;

    move-result-object v0

    iput-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->holder:Landroid/view/SurfaceHolder;

    .line 42
    new-instance v0, Landroid/app/ProgressDialog;

    iget-object v1, p0, Lcom/hdc/view/AndroidFastRenderView;->activity:Lcom/hdc/mygame/MyGameActivity;

    invoke-direct {v0, v1}, Landroid/app/ProgressDialog;-><init>(Landroid/content/Context;)V

    iput-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->dialog:Landroid/app/ProgressDialog;

    .line 43
    iget-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->dialog:Landroid/app/ProgressDialog;

    const-string v1, "\u0110ang ki\u1ec3m tra d\u1eef li\u1ec7u ..."

    invoke-virtual {v0, v1}, Landroid/app/ProgressDialog;->setMessage(Ljava/lang/CharSequence;)V

    .line 44
    return-void
.end method

.method static synthetic access$0()I
    .locals 1

    .prologue
    .line 26
    sget v0, Lcom/hdc/view/AndroidFastRenderView;->count:I

    return v0
.end method

.method static synthetic access$1(I)V
    .locals 0
    .parameter

    .prologue
    .line 26
    sput p0, Lcom/hdc/view/AndroidFastRenderView;->count:I

    return-void
.end method

.method public static getCount()I
    .locals 1

    .prologue
    .line 30
    sget v0, Lcom/hdc/view/AndroidFastRenderView;->count:I

    return v0
.end method

.method public static setCount(I)V
    .locals 0
    .parameter "count"

    .prologue
    .line 34
    sput p0, Lcom/hdc/view/AndroidFastRenderView;->count:I

    .line 35
    return-void
.end method


# virtual methods
.method public cancelAsyntask()V
    .locals 2

    .prologue
    .line 144
    iget-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->s:Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;

    const/4 v1, 0x1

    invoke-virtual {v0, v1}, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->cancel(Z)Z

    .line 145
    return-void
.end method

.method public pause()V
    .locals 1

    .prologue
    const/4 v0, 0x0

    .line 148
    iput-boolean v0, p0, Lcom/hdc/view/AndroidFastRenderView;->running:Z

    .line 149
    invoke-static {v0}, Lcom/hdc/view/AndroidFastRenderView;->setCount(I)V

    .line 152
    :goto_0
    :try_start_0
    iget-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->renderThread:Ljava/lang/Thread;

    invoke-virtual {v0}, Ljava/lang/Thread;->join()V
    :try_end_0
    .catch Ljava/lang/InterruptedException; {:try_start_0 .. :try_end_0} :catch_0

    .line 158
    return-void

    .line 154
    :catch_0
    move-exception v0

    goto :goto_0
.end method

.method public resume()V
    .locals 2

    .prologue
    .line 48
    const/4 v0, 0x1

    :try_start_0
    iput-boolean v0, p0, Lcom/hdc/view/AndroidFastRenderView;->running:Z

    .line 49
    new-instance v0, Ljava/lang/Thread;

    invoke-direct {v0, p0}, Ljava/lang/Thread;-><init>(Ljava/lang/Runnable;)V

    iput-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->renderThread:Ljava/lang/Thread;

    .line 50
    iget-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->renderThread:Ljava/lang/Thread;

    invoke-virtual {v0}, Ljava/lang/Thread;->start()V

    .line 51
    const/4 v0, 0x0

    invoke-static {v0}, Lcom/hdc/view/AndroidFastRenderView;->setCount(I)V

    .line 52
    sget-object v0, Lcom/hdc/mygame/MyGameActivity;->instance:Lcom/hdc/mygame/MyGameActivity;

    iget-boolean v0, v0, Lcom/hdc/mygame/MyGameActivity;->isConnect:Z

    if-eqz v0, :cond_0

    .line 53
    iget-object v0, p0, Lcom/hdc/view/AndroidFastRenderView;->s:Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;

    const/4 v1, 0x0

    invoke-virtual {v0, v1}, Lcom/hdc/view/AndroidFastRenderView$SavePhotoTask;->execute([Ljava/lang/Object;)Landroid/os/AsyncTask;

    .line 54
    const-string v0, "dialog"

    const-string v1, "show"

    invoke-static {v0, v1}, Landroid/util/Log;->i(Ljava/lang/String;Ljava/lang/String;)I
    :try_end_0
    .catch Ljava/lang/Exception; {:try_start_0 .. :try_end_0} :catch_0

    .line 59
    :cond_0
    :goto_0
    return-void

    .line 56
    :catch_0
    move-exception v0

    goto :goto_0
.end method

.method public run()V
    .locals 8

    .prologue
    .line 113
    :cond_0
    :goto_0
    iget-boolean v3, p0, Lcom/hdc/view/AndroidFastRenderView;->running:Z

    if-nez v3, :cond_1

    .line 141
    return-void

    .line 114
    :cond_1
    new-instance v1, Landroid/graphics/Rect;

    invoke-direct {v1}, Landroid/graphics/Rect;-><init>()V

    .line 115
    .local v1, dstRect:Landroid/graphics/Rect;
    const/4 v0, 0x0

    .line 117
    .local v0, canvas:Landroid/graphics/Canvas;
    :try_start_0
    iget-object v3, p0, Lcom/hdc/view/AndroidFastRenderView;->holder:Landroid/view/SurfaceHolder;

    invoke-interface {v3}, Landroid/view/SurfaceHolder;->getSurface()Landroid/view/Surface;

    move-result-object v3

    invoke-virtual {v3}, Landroid/view/Surface;->isValid()Z
    :try_end_0
    .catchall {:try_start_0 .. :try_end_0} :catchall_1
    .catch Ljava/lang/Exception; {:try_start_0 .. :try_end_0} :catch_1

    move-result v3

    if-nez v3, :cond_2

    .line 137
    if-eqz v0, :cond_0

    .line 138
    iget-object v3, p0, Lcom/hdc/view/AndroidFastRenderView;->holder:Landroid/view/SurfaceHolder;

    invoke-interface {v3, v0}, Landroid/view/SurfaceHolder;->unlockCanvasAndPost(Landroid/graphics/Canvas;)V

    goto :goto_0

    .line 121
    :cond_2
    :try_start_1
    iget v3, p0, Lcom/hdc/view/AndroidFastRenderView;->time:I

    int-to-long v3, v3

    invoke-static {v3, v4}, Ljava/lang/Thread;->sleep(J)V
    :try_end_1
    .catchall {:try_start_1 .. :try_end_1} :catchall_1
    .catch Ljava/lang/InterruptedException; {:try_start_1 .. :try_end_1} :catch_0
    .catch Ljava/lang/Exception; {:try_start_1 .. :try_end_1} :catch_1

    .line 127
    :goto_1
    :try_start_2
    iget-object v3, p0, Lcom/hdc/view/AndroidFastRenderView;->holder:Landroid/view/SurfaceHolder;

    const/4 v4, 0x0

    invoke-interface {v3, v4}, Landroid/view/SurfaceHolder;->lockCanvas(Landroid/graphics/Rect;)Landroid/graphics/Canvas;

    move-result-object v0

    .line 128
    iget-object v4, p0, Lcom/hdc/view/AndroidFastRenderView;->holder:Landroid/view/SurfaceHolder;

    monitor-enter v4
    :try_end_2
    .catchall {:try_start_2 .. :try_end_2} :catchall_1
    .catch Ljava/lang/Exception; {:try_start_2 .. :try_end_2} :catch_1

    .line 129
    :try_start_3
    invoke-static {}, Ljava/lang/System;->gc()V

    .line 130
    invoke-virtual {v0, v1}, Landroid/graphics/Canvas;->getClipBounds(Landroid/graphics/Rect;)Z

    .line 131
    iget-object v3, p0, Lcom/hdc/view/AndroidFastRenderView;->framebuffer:Landroid/graphics/Bitmap;

    const/4 v5, 0x0

    new-instance v6, Landroid/graphics/Paint;

    .line 132
    const/4 v7, 0x2

    invoke-direct {v6, v7}, Landroid/graphics/Paint;-><init>(I)V

    .line 131
    invoke-virtual {v0, v3, v5, v1, v6}, Landroid/graphics/Canvas;->drawBitmap(Landroid/graphics/Bitmap;Landroid/graphics/Rect;Landroid/graphics/Rect;Landroid/graphics/Paint;)V

    .line 128
    monitor-exit v4
    :try_end_3
    .catchall {:try_start_3 .. :try_end_3} :catchall_0

    .line 137
    if-eqz v0, :cond_0

    .line 138
    iget-object v3, p0, Lcom/hdc/view/AndroidFastRenderView;->holder:Landroid/view/SurfaceHolder;

    invoke-interface {v3, v0}, Landroid/view/SurfaceHolder;->unlockCanvasAndPost(Landroid/graphics/Canvas;)V

    goto :goto_0

    .line 122
    :catch_0
    move-exception v2

    .line 124
    .local v2, e:Ljava/lang/InterruptedException;
    :try_start_4
    invoke-virtual {v2}, Ljava/lang/InterruptedException;->printStackTrace()V
    :try_end_4
    .catchall {:try_start_4 .. :try_end_4} :catchall_1
    .catch Ljava/lang/Exception; {:try_start_4 .. :try_end_4} :catch_1

    goto :goto_1

    .line 134
    .end local v2           #e:Ljava/lang/InterruptedException;
    :catch_1
    move-exception v2

    .line 135
    .local v2, e:Ljava/lang/Exception;
    :try_start_5
    invoke-virtual {v2}, Ljava/lang/Exception;->printStackTrace()V
    :try_end_5
    .catchall {:try_start_5 .. :try_end_5} :catchall_1

    .line 137
    if-eqz v0, :cond_0

    .line 138
    iget-object v3, p0, Lcom/hdc/view/AndroidFastRenderView;->holder:Landroid/view/SurfaceHolder;

    invoke-interface {v3, v0}, Landroid/view/SurfaceHolder;->unlockCanvasAndPost(Landroid/graphics/Canvas;)V

    goto :goto_0

    .line 128
    .end local v2           #e:Ljava/lang/Exception;
    :catchall_0
    move-exception v3

    :try_start_6
    monitor-exit v4
    :try_end_6
    .catchall {:try_start_6 .. :try_end_6} :catchall_0

    :try_start_7
    throw v3
    :try_end_7
    .catchall {:try_start_7 .. :try_end_7} :catchall_1
    .catch Ljava/lang/Exception; {:try_start_7 .. :try_end_7} :catch_1

    .line 136
    :catchall_1
    move-exception v3

    .line 137
    if-eqz v0, :cond_3

    .line 138
    iget-object v4, p0, Lcom/hdc/view/AndroidFastRenderView;->holder:Landroid/view/SurfaceHolder;

    invoke-interface {v4, v0}, Landroid/view/SurfaceHolder;->unlockCanvasAndPost(Landroid/graphics/Canvas;)V

    .line 139
    :cond_3
    throw v3
.end method
