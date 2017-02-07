$(window).load(function(){

    var editor = new Simditor({

        textarea: $('#content'),

        upload: {
            url: '<?php echo "upload.php"?>',
            fileKey:'file1'
        },

        placeholder:"请输入正文",

        toolbar:[
            'title',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'fontScale',
            'color',
            'ol',           
            'ul' ,          
            'blockquote',
            'code' ,         
            'table',
            'link',
            'image',
            'hr',            
            'indent',
            'outdent',
            'alignment'
        ]
    })
});

 