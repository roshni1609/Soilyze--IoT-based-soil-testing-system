import xlrd 
import requests
# Give the location of the file 
loc = ("final.xlsx") 
  
wb = xlrd.open_workbook(loc) 
sheet = wb.sheet_by_index(0) 

  
# # Extracting number of rows 
print(sheet.nrows)
d={}
for i in range(1,69):
    d['name']=sheet.cell_value(i, 0)
    d['type']=sheet.cell_value(i, 3)
    d['ph_low']=sheet.cell_value(i, 1)
    d['ph_high']=sheet.cell_value(i, 2)
    d['n']=sheet.cell_value(i, 4)
    d['p']=sheet.cell_value(i, 5)
    d['k']=sheet.cell_value(i, 6)
    d['description']=sheet.cell_value(i, 9).replace("'","")
    d['fertilizer']=sheet.cell_value(i, 7)
    d['external_link']=sheet.cell_value(i, 8)
    d['image_src']="".join(d['name'].split()).lower()+".jpeg"

    x=requests.post("http://127.0.0.1/tools/crreg.php", data = d)
    print(x.text)