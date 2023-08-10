from django.shortcuts import render
from django.views.generic import ListView
from ksuser.models import GeneralDataMachine,LookupValue,Location,Company
from ksuser.forms.fGeneralDataMachine import GeneralDataMachineForm
from ksadmin.models import servicerequest
from ksuser.forms.fLookValue import LookUpValueForm
from ksuser.forms.fLookValue import *
from django.db.models import Q,F

def setOperator(inValue):
        operator = ""
        if len(inValue) > 0:
            if inValue[:1] == "*" and inValue[-1:] == "*":
                operator = "__contains"
            elif inValue[:1] == "*":
                operator = "__endswith"
            elif inValue[-1:] == "*":
                operator = "__startswith"
            else:
                if not inValue.replace("-", "").isdigit():
                    operator = "__iexact"

        return operator



class IndexAdmin(ListView):
    def get(self, request):

        # machine = GeneralDataMachine.objects.all
        companyList = Company.objects.filter(del_flg=False)
        machine_types = LookUpValueForm.getByTypeCode('Mechine Type')
        # numofmachine =  GeneralDataMachine.objects.all().count() 

        infilterKwargs = {} #filter
        infilterKwargsLv2 = {} #ไม่ต้องสนใจไปก่อน
        inFieldKwargs = {} #filedที่joinไปหา
        orderBy= '-id'

        inFieldKwargs['machine_type_name'] = F('machine_type_id__description')
        inFieldKwargs['company_name'] = F('location_id__company_id__name_company')
        infilterKwargs['del_flg'] = False
        infilterKwargs['servicerequest__status_id__value_code'] = 'apporve'
        infilterKwargs['servicerequest__type_id__value_code'] = 'requestregistermachine'
        infilterKwargs['servicerequest__del_flg'] = False
        formDataMachine = GeneralDataMachineForm.getObjAllJSON(infilterKwargs, infilterKwargsLv2, inFieldKwargs, orderBy)
        context = {
            "Generalmachine" : formDataMachine,
            "numofmachine" : len(formDataMachine),
            "companyList":companyList,
            "machine_types":machine_types
            # "Company_name" : company_name,
            # "machine_types" : machine_types,
            }

        return render(request,'IndexAdmin.html',context)
    def post(self,request):
        companyList = Company.objects.filter(del_flg=False)
        machine_types = LookUpValueForm.getByTypeCode('Mechine Type')
        numofmachine =  GeneralDataMachine.objects.all().count() 

        infilterKwargs = {} #filter
        infilterKwargsLv2 = {} #ไม่ต้องสนใจไปก่อน
        inFieldKwargs = {} #filedที่joinไปหา
        orderBy= '-id'

        inFieldKwargs['machine_type_name'] = F('machine_type_id__description')
        inFieldKwargs['company_name'] = F('location_id__company_id__name_company')

        if request.POST['machine_numberS'] != "" or None:
            searchvalMacNum = request.POST['machine_numberS']
            operator = setOperator(searchvalMacNum)
            infilterKwargs['machine_number' + operator ] = searchvalMacNum.replace("*","")
        if request.POST['machine_nameS'] != "" or None:
            searchvalMacName = request.POST['machine_nameS']
            operator = setOperator(searchvalMacName)
            infilterKwargs['machine_name' + operator ] = searchvalMacName.replace("*","")
            
        if request.POST['machine_typeS'] != '0' :
            infilterKwargs['machine_type_id'] = request.POST['machine_typeS']
        if request.POST['company_nameS'] != '0' :
            infilterKwargs['location_id__company_id'] = request.POST['company_nameS']

        infilterKwargs['servicerequest__status_id__value_code'] = 'apporve'
        infilterKwargs['servicerequest__type_id__value_code'] = 'requestregistermachine'
        infilterKwargs['servicerequest__del_flg'] = False
        infilterKwargs['del_flg'] = False
        formDataMachine = GeneralDataMachineForm.getObjAllJSON(infilterKwargs, infilterKwargsLv2, inFieldKwargs, orderBy)
        context = {
            "Generalmachine" : formDataMachine,
            "numofmachine" : len(formDataMachine),
            "companyList":companyList,
            "machine_types":machine_types
            # "Company_name" : company_name,
            # "machine_types" : machine_types,
            }

        return render(request,'IndexAdmin.html',context)