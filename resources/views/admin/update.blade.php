<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .form-container {
            width: 100%;
            max-width: 1800px;
            margin: auto;
            background: white;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 20px;
            padding: 20px;
            /* border-top: 2px solid #021962; */
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            color: #021962;
            font-size: 14px;
            margin-bottom: 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .table{
            border-bottom: 2px solid #021962;
        }

        .submit-btn {
            background-color: #021962; /* Dark blue shade */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            display: block;
            margin: 20px auto;
            width: 150px;
            text-align: center;
        }

        .submit-btn:hover {
            background-color: #021962; /* Darker blue */
        }

        .submit-btn:active {
            background-color: #021962; /* Even darker blue */
        }


        @media (max-width: 768px) {
            .form-header, .form-row {
                grid-template-columns: 2fr;
                /* border-top: 2px solid #021962; */
                gap: 15px;
            }

            .logo {
                width: 60%; /* Adjust logo size for mobile screens */
            }
        }
    </style>
</head>
<body>
    
    
    

    <div class="form-container">

        <div style="margin: 20px; text-align: center; display: flex; align-items: center; justify-content: center;">
            <img class="logo" src="{{asset('dist/assets/img/logo/logo.png')}}" alt="" style="width: 12%; height: auto; margin-right: 20px; max-width: 100%; height: auto;">
            <h2 style="margin: 0;">20/20 Plumbing Router RV</h2>
        </div>

        <form action="{{ route('form.update', ['recnum' => $record->recnum]) }}" method="POST">
            @csrf

            <h2 style="text-align: center;">Job Information</h2>
            <div class="form-header">
                <div class="form-group">
                    <label>Job Type:</label>
                    <select name="jobType">
                        <option {{ $record->jobType == 'COM' ? 'selected' : '' }} value="COM">COM</option>
                        <option {{ $record->jobType == 'SFH' ? 'selected' : '' }}  value="SFH">SFH</option>
                    </select>
                </div>
                <div class="form-group"><label>Description:</label><input id="description" name="description" value="{{$record->descript}}" type="text"></div>
                <div class="form-group"><label>Phase:</label><input id="phase" name="phase" value="{{ $record->phase }}" type="text"></div>
                <div class="form-group"><label>Units:</label><input type="number" name="units" value="{{ $record->units }}"  id="units"></div>

            </div>

            <div class="form-row">
                <div class="form-group"><label>Material:</label><input id="material" name="material" value="{{ $record->material }}" type="text"></div>
                <div class="form-group"><label>System:</label><input id="sys" name="sys" value="{{$record->sys}}" type="text"></div>
                <div class="form-group"><label>Bldg - Floor:</label><input id="bldFloor" value="{{ $record->bldFloor }}" name="bldFloor" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit" value="{{ $record->zoneUnit }}" type="text"></div>
            </div>

            <div class="form-row table">
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx" value="{{ $record->dx }}" type="text"></div>
                <div class="form-group"><label>Rough Super:</label><input type="text" value="{{ $record->roughSuper }}" id="roughSuper" required name="roughSuper"></div>
                <div class="form-group"><label>Finish Super:</label><input type="text" value="{{ $record->finishSuper }}" id="finishSuper" name="finishSuper"></div>
                <div class="form-group"><label>Engineer:</label><input type="text" value="{{ $record->engineer }}" id="engineer" name="engineer"></div>
            </div>

            <h2 style="text-align: center;">Job Status</h2>


            <div class="form-row">
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded" value="{{ $record->dateNeeded }}" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded" value="{{ $record->engNeeded }}" type="date"></div>
                <div class="form-group"><label>Eng Complete:</label><input id="engComplete" name="engComplete" value="{{ $record->engComplete }}" type="date"></div>
                <div class="form-group"><label>WRHS Misc Complete:</label><input id="wrhsMiscComplete" name="wrhsMiscComplete" value="{{ $record->prwr }}" type="date"></div>
            </div>

            <div class="form-row">
                <div class="form-group"><label>FAB Complete:</label><input id="fabComplete" name="fabComplete" value="{{ $record->fabwr }}" type="date"></div>
                <div class="form-group"><label>Ship Complete:</label><input id="shipComplete" name="shipComplete" value="{{ $record->shipComplete }}" type="date"></div>
            </div>

            <div class="form-row">
                <div class="form-group"><label>FFAB MISC:</label><input id="FebMisc" name="febMisc" value="{{ $record->fabmisc }}" type="text"></div>
                {{-- <div class="form-group"><label>WRHS2FAB:</label><input id="wrhs2Feb" name="wrhs2Feb" value="{{ $record->wrhs2_feb }}" type="date"></div> --}}
            </div>

            <div class="form-row table">
                <div class="form-group"><label>Note:</label><input id="note" name="note" value="{{ $record->notes }}" type="text"></div>
            </div>



            <button class="submit-btn" type="submit">Update</button>
        </form>
    </div>
</body>
</html>
