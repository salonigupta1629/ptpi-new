{{-- <div>
<div class="container">
    <header>
        <h1>Your Exam Results</h1>
        <p class="description">Below are your qualified exams. You can apply separately for each subject.</p>
    </header>
    
    <section class="exam-results">
        <table>
            <thead>
                <tr>
                    <th>SUBJECT</th>
                    <th>CLASS</th>
                    <th>LANGUAGE</th>
                    <th>SCORE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mathematics</td>
                    <td>0 to 2</td>
                    <td>English</td>
                    <td>40%</td>
                    <td><button class="apply-btn">Apply</button></td>
                </tr>
                <tr>
                    <td>Science</td>
                    <td>3 to 5</td>
                    <td>English</td>
                    <td>100%</td>
                    <td><button class="apply-btn">Apply</button></td>
                </tr>
                <tr>
                    <td>English</td>
                    <td>6 to 8</td>
                    <td>English</td>
                    <td>0%</td>
                    <td><button class="apply-btn">Apply</button></td>
                </tr>
                <tr>
                    <td>History</td>
                    <td>9 to 10</td>
                    <td>Hindi</td>
                    <td>95%</td>
                    <td><button class="apply-btn">Apply</button></td>
                </tr>
            </tbody>
        </table>
    </section>
    
    <section class="job-preferences">
        <div class="preferences-header">
            <h2>Job Preference Locations</h2>
            <button class="add-btn">+ Add</button>
        </div>
        
        <div class="empty-state">
            <p>You haven't added any job preference locations yet!</p>
            <p class="info">Choose up to 5 preferred locations to find jobs tailored to your choices.</p>
        </div>
    </section>
</div>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f5f5;
        color: #333;
        padding: 20px;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    header {
        margin-bottom: 30px;
    }
    
    h1 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .description {
        color: #666;
        font-size: 14px;
    }
    
    .exam-results {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 30px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    
    th {
        text-align: left;
        padding: 12px 15px;
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
        color: #495057;
    }
    
    td {
        padding: 12px 15px;
        border-bottom: 1px solid #dee2e6;
    }
    
    .apply-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.2s;
    }
    
    .apply-btn:hover {
        background-color: #0069d9;
    }
    
    .job-preferences {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    
    .preferences-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    h2 {
        font-size: 20px;
        font-weight: 600;
    }
    
    .add-btn {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: background-color 0.2s;
    }
    
    .add-btn:hover {
        background-color: #218838;
    }
    
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }
    
    .empty-state p {
        margin-bottom: 15px;
        font-size: 16px;
    }
    
    .empty-state .info {
        font-size: 14px;
        color: #868e96;
    }
    
    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
        }
        
        th, td {
            white-space: nowrap;
        }
        
        .preferences-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .add-btn {
            align-self: flex-end;
        }
    }
</style>
</div> --}}

<div>
   <div class="min-h-screen bg-gray-50">
        <header>
            <h1>Your Exam Results</h1>
            <p class="description">Below are your qualified exams. You can apply separately for each subject.</p>
        </header>
        
        <section class="exam-results">
            <table>
                <thead>
                    <tr>
                        <th>SUBJECT</th>
                        <th>CLASS</th>
                        <th>LANGUAGE</th>
                        <th>SCORE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mathematics</td>
                        <td>0 to 2</td>
                        <td>English</td>
                        <td>40%</td>
                        <td><button class="apply-btn">Apply</button></td>
                    </tr>
                    <tr>
                        <td>Science</td>
                        <td>3 to 5</td>
                        <td>English</td>
                        <td>100%</td>
                        <td><button class="apply-btn">Apply</button></td>
                    </tr>
                    <tr>
                        <td>English</td>
                        <td>6 to 8</td>
                        <td>English</td>
                        <td>0%</td>
                        <td><button class="apply-btn">Apply</button></td>
                    </tr>
                    <tr>
                        <td>History</td>
                        <td>9 to 10</td>
                        <td>Hindi</td>
                        <td>95%</td>
                        <td><button class="apply-btn">Apply</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
        
        <section class="job-preferences">
            <div class="preferences-header">
                <h2>Job Preference Locations</h2>
                <button class="add-btn">+ Add</button>
            </div>
            
            <div class="empty-state">
                <p>You haven't added any job preference locations yet!</p>
                <p class="info">Choose up to 5 preferred locations to find jobs tailored to your choices.</p>
            </div>
        </section>
    </div>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            margin-bottom: 30px;
        }
        
        h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .description {
            color: #666;
            font-size: 14px;
        }
        
        .exam-results {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        th {
            text-align: left;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
            color: #495057;
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }
        
        .apply-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s;
        }
        
        .apply-btn:hover {
            background-color: #0069d9;
        }
        
        .job-preferences {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        
        .preferences-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        h2 {
            font-size: 20px;
            font-weight: 600;
        }
        
        .add-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background-color 0.2s;
        }
        
        .add-btn:hover {
            background-color: #218838;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6c757d;
        }
        
        .empty-state p {
            margin-bottom: 15px;
            font-size: 16px;
        }
        
        .empty-state .info {
            font-size: 14px;
            color: #868e96;
        }
        
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
            }
            
            th, td {
                white-space: nowrap;
            }
            
            .preferences-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .add-btn {
                align-self: flex-end;
            }
        }
    </style>
</div>