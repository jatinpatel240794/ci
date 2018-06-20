<!DOCTYPE html>
<html>

<head>

  <link data-require="bootstrap-css@*" data-semver="3.0.3" rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/excel_style.css" />
</head>

<body ng-app="gridApp">
  <div class="container">
    <h1>Excel Sheet in AngularJS!</h1>
    <p class="alert alert-info">Right click on cells to avail actions</p>
    <div ng-controller="GridCtrl" class="spreadsheet-container">
      <table class="spreadsheet table table-condensed table-striped table-bordered">
        <thead>
          <tr class="row-header">
            <th class="col-sno"></th>
            <td class="col text-center" ng-repeat="col in records[0]">
              <span>{{$index}}</span>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="record in records">
            <td class="col-sno text-center">{{$index}}</td>
            <td class="col" ng-repeat="col in record" ng-right-click="openContextMenu($event, $parent.$index, $index)" ng-click="openContextMenu($event, $parent.$index, $index)">
              <input class="editable-cell" ng-model="col.value" />
            </td>
          </tr>
        </tbody>
      </table>
       <div class="context-menu" ng-show="isContextMenuVisible" ng-style="contextMenuStyle">
        <ul class="dropdown-menu">
          <li>
            <a tabindex="-1" ng-click="addRow()">Add Row</a>
          </li>
          <li>
            <a tabindex="-1" ng-click="removeRow()">Remove Row</a>
          </li>
          <li>
            <a tabindex="-1" ng-click="addColumn()">Add Column</a>
          </li>
          <li>
            <a tabindex="-1" ng-click="removeColumn()">Remove Column</a>
          </li>
        </ul>
      </div>
    </div>
    </div>
  </div>
  <script data-require="jquery@*"  src="<?php echo base_url(); ?>js/jQuery/jquery.min.js"></script>
  <script data-require="angular.js@*" data-semver="1.2.11" src="<?php echo base_url(); ?>js/angular.min.js"></script>
  <script src="<?php echo base_url(); ?>js/excel-script.js"></script>
</body>

</html>
