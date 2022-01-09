
{{var_func_del_loader_page}}
{{var_func_del_loader_page}}

# var_loader_page= ''' <!-- start Loader #################################### -->
#         <div id="loader-wrapper">
#             <div id="loader">
#                 <svg height="100" width="100">
# 					<circle
# 					  cx="50"
# 					  cy="50"
# 					  r="40"
# 					  stroke="black"
# 					  stroke-width="3"
# 					  fill="#3498DB"
# 		   />
# 				  </svg>
#             </div>
            
#             <div class="loader-section section-left"></div>
#             <div class="loader-section section-right"></div>

#         </div>
       
#         <!-- end Loader ///////////////////////////////////// -->
# '''




def func_write_to_lodaer_page():
    with open('templates/lo.html','w') as html_file:
        html_file.write(var_loader_page)
        html_file.close()
        
#var_func_write_to_lodaer_page=func_write_to_lodaer_page()

def func_del_loader_page():
    try:
        webbrowser.subprocess.os.remove('templates/lo.html')
    except:
        pass

