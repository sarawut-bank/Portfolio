from django.shortcuts import render,redirect
from django.views.generic import ListView
from ksadmin.forms.fCompany import CompanyForm
from django.http import HttpResponse
from django.core.serializers.json import DjangoJSONEncoder
import json

class Company(ListView):
    def get(self ,request):
        infilterKwargs = {} 
        infilterKwargsLv2 = {} 
        inFieldKwargs = {} 
        orderBy= '-id'
        companyData = CompanyForm.getObjAllJSON(infilterKwargs, infilterKwargsLv2, inFieldKwargs, orderBy)
        context = {
            "companyData":list(companyData.values()),
        }
        return render(request, 'Company.html', context)
    
    def post(self,request):
        infilterKwargs = {} 
        infilterKwargsLv2 = {} 
        inFieldKwargs = {} 
        orderBy= '-id'

        infilterKwargs['del_flg'] = False
        if request.POST['option'] != "0": 
            infilterKwargs['id'] = request.POST['option']
        if 'company_id' in request.POST:
            infilterKwargs['id'] = request.POST['company_id']
        companyData = CompanyForm.getObjAllJSON(infilterKwargs, infilterKwargsLv2, inFieldKwargs, orderBy)
        context = {
            "status":"success",
            "companyData":list(companyData.values()),
        }
        return HttpResponse(json.dumps(context,cls=DjangoJSONEncoder),content_type="application/json")
    
class EditCompany(ListView):
    def post(self ,request):
        try:

            CompanyForm.setValue(request.POST['company_id'],{
                'name_company': request.POST['name_company'],
                'address_company' : request.POST['address_company'],
                'abb_company': request.POST['abb_company'],
            })

            infilterKwargs = {} 
            infilterKwargsLv2 = {} 
            inFieldKwargs = {} 
            orderBy= '-id'

            infilterKwargs['del_flg'] = False
            if request.POST['option'] != "0": 
                infilterKwargs['id'] = request.POST['option']
            if 'company_id' in request.POST:
                infilterKwargs['id'] = request.POST['company_id']

            companyData = CompanyForm.getObjAllJSON(infilterKwargs, infilterKwargsLv2, inFieldKwargs, orderBy)
            context = {
                "status":"success",
                "companyData":list(companyData.values()),
            }
            return HttpResponse(json.dumps(context,cls=DjangoJSONEncoder),content_type="application/json")
        except Exception as e:
            context = {
                "status" : "failed",
                "error_msg" :{e},
            }
            return HttpResponse(json.dumps(context,cls=DjangoJSONEncoder),content_type="application/json")

class DeleteCompany(ListView):
    def post(self, request):

        CompanyForm.setValue(request.POST['company_id'],{
            'del_flg': True
        })
        
        infilterKwargs = {} 
        infilterKwargsLv2 = {} 
        inFieldKwargs = {} 
        orderBy= '-id'

        infilterKwargs['del_flg'] = False
        if request.POST['option'] != "0": 
            infilterKwargs['id'] = request.POST['option']
        if 'company_id' in request.POST:
            infilterKwargs['id'] = request.POST['company_id']

        companyData = CompanyForm.getObjAllJSON(infilterKwargs, infilterKwargsLv2, inFieldKwargs, orderBy)
        context = {
                "status":"success",
                "companyData":list(companyData.values()),
            }
        return HttpResponse(json.dumps(context,cls=DjangoJSONEncoder),content_type="application/json")
    
class addnewCompany(ListView):
    def post(self, request):

        addDataCompany = {
            'name_company': request.POST['name_company'],
            'abb_company': request.POST['abb_company'],
            'address_company': request.POST['address_company'],
        }

        companyData = CompanyForm(data=addDataCompany)
        if companyData.is_valid():
            companyData.save()

        return redirect('/addnewCompany')