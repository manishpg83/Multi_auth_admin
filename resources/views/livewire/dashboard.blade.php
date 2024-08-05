<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-cyan-500 h-30 flex flex-col justify-between">
            <div class="inner">
                <h3 class="text-2xl font-bold">{{ $clients }}</h3>
                <p class="text-sm">Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-badge text-2xl"></i>
            </div>
            <a href="{{ route('clients.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-yellow-400 h-30 flex flex-col justify-between">
            <div class="inner">
                <h3 class="text-2xl font-bold">#</h3>
                <p class="text-sm">Emails Sent</p>
            </div>
            <div class="icon">
                <i class="fas fa-paper-plane text-2xl"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-lime-500 h-30 flex flex-col justify-between">
            <div class="inner">
                <h3 class="text-2xl font-bold">{{ $emailsOpened }}</h3>
                <p class="text-sm">Emails Opened</p>
            </div>
            <div class="icon">
                <i class="fas fa-eye text-2xl"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-orange-400 h-30 flex flex-col justify-between">
            <div class="inner">
                <h3 class="text-2xl font-bold">65</h3>
                <p class="text-sm">Email Replied</p>
            </div>
            <div class="icon">
                <i class="fas fa-reply-all text-2xl"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->
