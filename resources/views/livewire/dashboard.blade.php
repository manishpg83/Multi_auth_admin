<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-cyan-500">
            <div class="inner">
                <h3>{{ $clients }}</h3>
                <p>Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-id-badge"></i>
            </div>
            <a href="{{ route('clients.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-yellow-400">
            <div class="inner">
                <h3>#</h3>
                <p>Emails Sent</p>
            </div>
            <div class="icon">
                <i class="fas fa-paper-plane"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-lime-500">
            <div class="inner">
                <h3>{{ $emailsOpened }}</h3>
                <p>Emails Opened</p>
            </div>
            <div class="icon">
                <i class="fas fa-eye"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-orange-400">
            <div class="inner">
                <h3>65</h3>
                <p>Email Replied</p>
            </div>
            <div class="icon">
                <i class="fas fa-reply-all"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->