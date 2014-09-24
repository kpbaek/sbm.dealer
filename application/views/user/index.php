<script type="text/javascript" src="/lib/assets/js/ext/ext-all.js"></script>
<script type="text/javascript">
var BASE_URL = '<?php echo base_url(); ?>';
var BASE_PATH = '<?php echo base_url(); ?>';
var BASE_ICONS = BASE_PATH + 'lib/assets/icons/';
Ext.onReady(function() {
alert("1111");	
var strUsers = new Ext.data.Store({
        reader: new Ext.data.JsonReader({
            fields: [
                'id', 'fullname', 'email', 'country_id',
                'country_name', 'occupation', 'birthdate'
            ],
            root: 'rows', totalProperty: 'results'
        }),
        proxy: new Ext.data.HttpProxy({
            url: BASE_URL + 'user/ext_get_all',
            method: 'POST'
        })
    });
alert("2222");	

    var tbUsers = new Ext.Toolbar({
        items:[{
            text: 'Add',
            icon: BASE_ICONS + 'user_add.png'
        }, '-', {
            text: 'Delete',
            icon: BASE_ICONS + 'user_delete.png'
        }]
    });
    
    var cbGrid = new Ext.grid.CheckboxSelectionModel();
    var gridUsers = new Ext.grid.GridPanel({
        frame: true, border: true, stripeRows: true, sm: cbGrid,
        store: strUsers, loadMask: true, title: 'Users List',
        style: 'margin:0 auto;', height: 330, width: 722,
        columns: [
            cbGrid, {
                header: "Fullname",
                dataIndex: 'fullname',
                width: 180
            }, {
                header: "Email",
                dataIndex: 'email',
                width: 180
            }, {
                header: "Country",
                dataIndex: 'country_name',
                width: 120
            }, {
                header: "Occupation",
                dataIndex: 'occupation',
                width: 120
            }, {
                header: "Birth",
                dataIndex: 'birthdate',
                width: 80,
                renderer : Ext.util.Format.dateRenderer('d/m/Y')
            }
        ],
        tbar: tbUsers,
        bbar: new Ext.PagingToolbar({
            pageSize: 10,
            store: strUsers,
            displayInfo: true
        })
    });

    gridUsers.render('divgrid');
    strUsers.load();
});
</script>