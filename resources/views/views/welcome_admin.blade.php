@extends('layouts.app')

@section('content')
   <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner"> -->
      <!-- @php
        $hour = date('H');
        
        $greeting = '';
        $emoji = '';
        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good Morning';
            $emoji = '☀️';
        } elseif ($hour >= 12 && $hour < 14) {
            $greeting = 'Good Afternoon';
            $emoji = '🌤️';
        } elseif ($hour >= 14 && $hour < 18) {
            $greeting = 'Good Evening';
            $emoji = '🌤️';
        } else {
            $greeting = 'Good Night';
            $emoji = '🌙';
        }
        @endphp 
        
        <h3>{{ $emoji }}</h3>
        <p>{{ $greeting }} ! {{ session()->get('name') }} :)</p> -->
        <!-- <h3>:)</h3>
        <p>Hi ! {{ session()->get('name') }}</p>
          </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Coming Soon <i class="fas fa-heart"></i></a>
            </div>
          </div> -->
          <!-- ./col -->


          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
              <h3>{{ $task_info[0]-> totalDueTasks }}</h3><sup style="font-size: 20px"></sup></h3>
                <p>Due Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-speedometer"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">more<i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $task_info[0]->totalActiveTasks }}</h3>
                <p> Active Tasks</p>
              </div>
              <div class="icon">
                 <i class="ion ion-stat-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">more<i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $task_info[0]->totalCompletedTasks }}</h3>

                <p>Total Completed Tasks</p>
              </div>
              <div class="icon">
                <i class="ion ion-trophy"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">more<i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->

        </div>


        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
         
        </div>

      </div>


<!-- <div class="col-lg-6 offset-lg-3">
            <div class="progress-card">
              <div class="progress-card-header">
                <div class="status-title">Status</div>
                <div class="toggle-filter">
                  <label class="toggle-label">
                    <input type="radio" name="filter" value="my" checked> My
                  </label>
                  <label class="toggle-label">
                    <input type="radio" name="filter" value="all"> All
                  </label>
                </div>
              </div>
              <div class="stage-progress">
                <div class="stage">Track</div>
                <div class="progress-bar">
                  <div class="track" style="width: 60%;"></div>
                </div>
              </div>
              <div class="stage-progress">
                <div class="stage">Backlog</div>
                <div class="progress-bar">
                  <div class="backlog" style="width: 30%;"></div>
                </div>
              </div>
              <div class="stage-progress">
                <div class="stage">Development</div>
                <div class="progress-bar">
                  <div class="development" style="width: 20%;"></div>
                </div>
              </div>
              <div class="stage-progress">
                <div class="stage">Working</div>
                <div class="progress-bar">
                  <div class="working" style="width: 40%;"></div>
                </div>
              </div>
              <div class="stage-progress">
                <div class="stage">Testing</div>
                <div class="progress-bar">
                  <div class="testing" style="width: 70%;"></div>
                </div>
              </div>
              <div class="stage-progress">
                <div class="stage">Live</div>
                <div class="progress-bar">
                  <div class="live" style="width: 90%;"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <!-- ... -->
        </div>
      </div>
    </section>

<style>
    .progress-card {
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 20px;
        text-align: center;
    }

    .progress-card-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .status-title {
        font-weight: bold;
    }

    .toggle-filter {
        display: flex;
    }

    .toggle-label {
        margin-right: 10px;
    }

    .stage-progress {
        margin-bottom: 20px;
    }

    .stage {
        font-weight: bold;
    }

    .progress-bar {
        height: 20px;
        background-color: #ccc;
        border-radius: 10px;
        margin-bottom: 10px;
        position: relative;
    }

    .track,
    .backlog,
    .development,
    .working,
    .testing,
    .live {
        height: 100%;
        position: absolute;
        border-radius: 10px;
    }

    .track {
        background-color: #FF5733;
    }

    .backlog {
        background-color: #FDB927;
    }

    .development {
        background-color: #007BFF;
    }

    .working {
        background-color: #28A745;
    }

    .testing {
        background-color: #6610F2;
    }

    .live {
        background-color: #17A2B8;
    }
</style> -->
@endsection
