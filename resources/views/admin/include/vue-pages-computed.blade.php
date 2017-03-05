computed:{
          pages:function(){
                var pag = [];
                if( this.current_page < this.totalsshowItem ){ /*如果当前的激活的项 小于要显示的条数*/
                  /*总页数和要显示的条数那个大就显示多少条*/
                  var i = Math.min(this.totalsshowItem,this.totals);
                  while(i){
                      pag.unshift(i--);
                  }
                }else{ /*当前页数大于显示页数了*/
                    var middle = this.current_page - Math.floor(this.totalsshowItem / 2 ),/*从哪里开始*/
                        i = this.totalsshowItem;
                    if( middle >  (this.totals - this.totalsshowItem)  ){
                        middle = (this.totals - this.totalsshowItem) + 1
                    }
                    while(i--){
                        pag.push( middle++ );
                    }
                }
                return pag;
          }
},