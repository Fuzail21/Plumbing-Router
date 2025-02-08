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
            border-bottom: 2px solid #021962;
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
                border-bottom: 2px solid #021962;
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

        <form action="{{ route('form.insert') }}" method="POST">
            @csrf
            <div class="form-header">
                <div class="form-group">
                    <label>Job Type:</label>
                    <select name="jobType">
                        <option value="COM">COM</option>
                        <option value="SFH">SFH</option>
                    </select>
                </div>
                <div class="form-group"><label>Job #:</label><input id="jobNum" name="jobNum" type="text"></div>
                <div class="form-group"><label>Description:</label><input id="description" name="description" type="text"></div>
                <div class="form-group"><label>Phase:</label><input id="phase" name="phase" type="text"></div>
                <div class="form-group"><label>Units:</label><input type="number" name="units"  id="units"></div>
                <div class="form-group"><label>Rough Super:</label><input type="text" id="roughSuper" required name="roughSuper"></div>
                <div class="form-group"><label>Finish Super:</label><input type="text" id="finishSuper" name="finishSuper"></div>
                <div class="form-group"><label>Engineer:</label><input type="text" id="engineer" name="engineer"></div>
                <div class="form-group"><label>PM/Act Manager:</label><input type="text" id="pmactmanager" name="pmactmanager"></div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system" required name="system[]">
                        <option disabled value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>


            


            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>





            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>







            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>






            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>





            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>







            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>










            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>









            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>








            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>









            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>









            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>













            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>










            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>









            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>










            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>











            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>


            




            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system"  name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>















            <div class="form-row">
                <div class="form-group">
                    <label>Material:</label>
                    <select id="material" name="material[]">
                        <option selected value="">-- select an option --</option>
                        <option value="ABS">ABS</option>
                        <option value="CPR">CPR</option>
                        <option value="BI">BI</option>
                        <option value="CANS">CANS</option>
                        <option value="OTHER">OTHER</option>
                        <option value="PVC">PVC</option>
                        <option value="CPVC">CPVC</option>
                        <option value="PE">PE</option>
                        <option value="ROD">ROD</option>
                        <option value="FINISH">FINISH</option>
                        <option value="NH">NH</option>
                        <option value="PEX">PEX</option>
                        <option value="WELD">WELD</option>
                        <option value="HANGER">HANGER</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label>System:</label>
                    <select id="system" name="system[]">
                        <option selected value="">-- select an option --</option>
                        <option value="GSDM">GSDM</option>
                        <option value="GS">GS</option>
                        <option value="GSSD">GSSD</option>
                        <option value="GW">GW</option>
                        <option value="BDS">BDS</option>
                        <option value="BDSD">BDSD</option>
                        <option value="BDW">BDW</option>
                        <option value="BDG">BDG</option>
                        <option value="DECK">DECK</option>
                        <option value="TOGM">TOGM</option>
                        <option value="CANS">CANS</option>
                        <option value="GSBL">GSBL</option>
                        <option value="GSGW">GSGW</option>
                        <option value="TOS">TOS</option>
                        <option value="TOSD">TOSD</option>
                        <option value="TOWM">TOWM</option>
                        <option value="TOW">TOW</option>
                        <option value="TOG">TOG</option>
                        <option value="BF">BF</option>
                        <option value="CON">CON</option>
                        <option value="GG">GG</option>
                        <option value="IRR">IRR</option>
                        <option value="COP">COP</option>
                    </select>
                </div>
                
                <div class="form-group"><label>Bld - Floor:</label><input id="bldFloor" name="bldFloor[]" type="text"></div>
                <div class="form-group"><label>Zone - Unit:</label><input id="zoneUnit" name="zoneUnit[]" type="text"></div>
                <div class="form-group"><label>D-X:</label><input id="dx" name="dx[]" type="text"></div>
                <div class="form-group"><label>Date Needed:</label><input id="dateNeeded" name="dateNeeded[]" type="date"></div>
                <div class="form-group"><label>Eng Date Needed:</label><input id="engNeeded" name="engNeeded[]" type="date"></div>
            </div>

            <button class="submit-btn" type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
