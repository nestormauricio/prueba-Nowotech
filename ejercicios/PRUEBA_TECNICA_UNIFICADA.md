# 🚀 PRUEBA TÉCNICA UNIFICADA - Sistema de Gestión de RRHH

## 📋 Información General

**Tiempo límite**: 5-7 horas  
**Stack tecnológico**: PHP 8.2+, Symfony 7, Vue.js 3, MySQL/PostgreSQL  
**Arquitectura**: Domain-Driven Design (DDD) + Event-Driven Architecture  
**Características**: Gestión de empleados, nóminas, eventos de dominio, APIs REST, Frontend interactivo  

---

## 🎯 Objetivo

Desarrollar un **Sistema de Gestión de RRHH** completo que permita gestionar empleados, nóminas, vacaciones y procesos de contratación, implementando **Event-Driven Architecture** y **CQRS** para demostrar el dominio de patrones arquitectónicos avanzados.

---

## 🏗️ Arquitectura Requerida

### Backend (Symfony 7 + DDD + Event-Driven)
- **Domain Layer**: Entidades, Value Objects, Domain Services, **Domain Events**
- **Application Layer**: Application Services, **Command/Query Handlers (CQRS)**
- **Infrastructure Layer**: Repositories, **Event Dispatchers**, External Services
- **API Layer**: REST Controllers, DTOs, Validators

### Frontend (Vue.js 3)
- **Componentes**: Reutilizables y modulares
- **Estado**: Pinia o Vuex
- **Routing**: Vue Router
- **UI/UX**: Moderna y responsive

---

## 📊 Funcionalidades a Implementar

### 1. Gestión de Empleados (Core Domain)
- ✅ Crear, editar, eliminar empleados
- ✅ Gestión de perfiles y datos personales
- ✅ Estados del empleado (Activo, Inactivo, Vacaciones, Baja)
- ✅ Gestión de departamentos y roles
- ✅ Historial de cambios y auditoría

### 2. Sistema de Nóminas
- ✅ Cálculo automático de nóminas
- ✅ Gestión de salarios y bonificaciones
- ✅ Cálculo de impuestos y retenciones
- ✅ Generación de recibos de salario
- ✅ Historial de nóminas

### 3. Gestión de Vacaciones y Ausencias
- ✅ Solicitud y aprobación de vacaciones
- ✅ Gestión de días festivos
- ✅ Control de ausencias y permisos
- ✅ Cálculo de días disponibles
- ✅ Workflow de aprobación

### 4. Procesos de Contratación
- ✅ Gestión de ofertas de trabajo
- ✅ Proceso de selección de candidatos
- ✅ Contratos y documentación
- ✅ Onboarding de nuevos empleados
- ✅ Evaluaciones de rendimiento

### 5. Event-Driven Architecture
- ✅ **Domain Events** para cambios de estado
- ✅ **Event Sourcing** para auditoría
- ✅ **CQRS** para separación de lecturas/escrituras
- ✅ **Event Handlers** para procesos asíncronos
- ✅ **Sagas** para transacciones distribuidas

### 6. APIs y Integración
- ✅ API REST completa con documentación
- ✅ Autenticación JWT
- ✅ Rate limiting y caching
- ✅ Webhooks para integraciones externas

---

## 🎨 Entidades del Dominio

### Employee (Agregado Raíz)
```php
// Domain/Employee/Employee.php
class Employee extends AggregateRoot
{
    private EmployeeId $id;
    private EmployeeName $name;
    private EmployeeEmail $email;
    private EmployeeSalary $salary;
    private EmployeeStatus $status;
    private Department $department;
    private Position $position;
    private Collection $contracts;
    private Collection $payrolls;
    private Collection $vacations;
    private Collection $domainEvents;
    
    // Métodos de dominio
    public function hire(Contract $contract): void
    public function terminate(TerminationReason $reason): void
    public function changeSalary(EmployeeSalary $newSalary): void
    public function requestVacation(VacationRequest $request): void
    public function approveVacation(VacationId $vacationId): void
    public function generatePayroll(PayrollPeriod $period): void
}
```

### Payroll (Entidad)
```php
// Domain/Payroll/Payroll.php
class Payroll
{
    private PayrollId $id;
    private EmployeeId $employeeId;
    private PayrollPeriod $period;
    private Money $grossSalary;
    private Money $netSalary;
    private Money $taxes;
    private Money $bonuses;
    private PayrollStatus $status;
}
```

### Vacation (Entidad)
```php
// Domain/Vacation/Vacation.php
class Vacation
{
    private VacationId $id;
    private EmployeeId $employeeId;
    private VacationPeriod $period;
    private VacationType $type;
    private VacationStatus $status;
    private ApprovalWorkflow $workflow;
}
```

---

## 🔧 Implementación Técnica

### 1. Estructura de Directorios (DDD + Event-Driven)
```
src/
├── Domain/
│   ├── Employee/
│   │   ├── Employee.php
│   │   ├── EmployeeId.php
│   │   ├── EmployeeRepository.php
│   │   ├── Event/
│   │   │   ├── EmployeeHired.php
│   │   │   ├── EmployeeTerminated.php
│   │   │   ├── SalaryChanged.php
│   │   │   └── DepartmentChanged.php
│   │   └── Exception/
│   ├── Payroll/
│   │   ├── Payroll.php
│   │   ├── PayrollId.php
│   │   ├── PayrollRepository.php
│   │   └── Event/
│   │       ├── PayrollGenerated.php
│   │       └── PayrollApproved.php
│   ├── Vacation/
│   │   ├── Vacation.php
│   │   ├── VacationId.php
│   │   ├── VacationRepository.php
│   │   └── Event/
│   │       ├── VacationRequested.php
│   │       └── VacationApproved.php
│   └── Shared/
│       ├── ValueObject/
│       ├── DomainEvent/
│       └── EventBus/
├── Application/
│   ├── Employee/
│   │   ├── Command/
│   │   │   ├── HireEmployee/
│   │   │   ├── TerminateEmployee/
│   │   │   └── ChangeSalary/
│   │   └── Query/
│   │       ├── GetEmployees/
│   │       └── GetEmployeeDetails/
│   ├── Payroll/
│   │   ├── Command/
│   │   │   ├── GeneratePayroll/
│   │   │   └── ApprovePayroll/
│   │   └── Query/
│   │       ├── GetPayrolls/
│   │       └── CalculateSalary/
│   └── Vacation/
│       ├── Command/
│       │   ├── RequestVacation/
│       │   └── ApproveVacation/
│       └── Query/
│           ├── GetVacations/
│           └── GetAvailableDays/
├── Infrastructure/
│   ├── Persistence/
│   ├── EventStore/
│   ├── EventDispatcher/
│   └── External/
└── Api/
    ├── Controller/
    ├── DTO/
    └── Validator/
```

### 2. Event Sourcing Implementation
```php
// Domain/Shared/EventStore/EventStore.php
class EventStore
{
    public function append(DomainEvent $event): void
    public function getEvents(AggregateId $aggregateId): array
    public function getEventsByType(string $eventType): array
}

// Infrastructure/EventStore/DoctrineEventStore.php
class DoctrineEventStore implements EventStore
{
    public function append(DomainEvent $event): void
    {
        $eventRecord = new EventRecord(
            $event->getAggregateId(),
            get_class($event),
            $event->getEventData(),
            $event->occurredOn()
        );
        
        $this->entityManager->persist($eventRecord);
        $this->entityManager->flush();
    }
}
```

### 3. CQRS Implementation
```php
// Application/Query/GetEmployees/GetEmployeesQuery.php
class GetEmployeesQuery
{
    public function __construct(
        public readonly ?string $department = null,
        public readonly ?EmployeeStatus $status = null,
        public readonly ?DateTime $hiredAfter = null,
        public readonly int $page = 1,
        public readonly int $limit = 20
    ) {}
}

// Application/Query/GetEmployees/GetEmployeesQueryHandler.php
class GetEmployeesQueryHandler
{
    public function __construct(
        private EmployeeQueryRepository $employeeQueryRepository
    ) {}
    
    public function __invoke(GetEmployeesQuery $query): PaginatedEmployeesResponse
    {
        return $this->employeeQueryRepository->findByCriteria($query);
    }
}

// Application/Command/HireEmployee/HireEmployeeCommand.php
class HireEmployeeCommand
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly Money $salary,
        public readonly string $department,
        public readonly string $position
    ) {}
}

// Application/Command/HireEmployee/HireEmployeeCommandHandler.php
class HireEmployeeCommandHandler
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private EventDispatcher $eventDispatcher
    ) {}
    
    public function __invoke(HireEmployeeCommand $command): EmployeeId
    {
        $employee = Employee::hire(
            EmployeeName::fromString($command->name),
            EmployeeEmail::fromString($command->email),
            EmployeeSalary::fromMoney($command->salary),
            Department::fromString($command->department),
            Position::fromString($command->position)
        );
        
        $this->employeeRepository->save($employee);
        
        // Dispatch domain events
        foreach ($employee->pullDomainEvents() as $event) {
            $this->eventDispatcher->dispatch($event);
        }
        
        return $employee->getId();
    }
}
```

---

## 🎯 Event-Driven Architecture

### 1. Domain Events
```php
// Domain/Employee/Event/EmployeeHired.php
class EmployeeHired implements DomainEvent
{
    public function __construct(
        private EmployeeId $employeeId,
        private EmployeeName $name,
        private EmployeeEmail $email,
        private Department $department,
        private \DateTimeImmutable $hiredAt
    ) {}
    
    public function occurredOn(): \DateTimeImmutable
    {
        return $this->hiredAt;
    }
    
    public function getEventData(): array
    {
        return [
            'employeeId' => $this->employeeId->value(),
            'name' => $this->name->value(),
            'email' => $this->email->value(),
            'department' => $this->department->value(),
            'hiredAt' => $this->hiredAt->format('Y-m-d H:i:s')
        ];
    }
}
```

### 2. Event Handlers
```php
// Infrastructure/EventHandler/EmployeeHiredHandler.php
class EmployeeHiredHandler implements EventHandler
{
    public function __construct(
        private EmailService $emailService,
        private NotificationService $notificationService,
        private PayrollService $payrollService
    ) {}
    
    public function handle(DomainEvent $event): void
    {
        if (!$event instanceof EmployeeHired) {
            return;
        }
        
        // Enviar email de bienvenida
        $this->emailService->sendWelcomeEmail($event->getEmail());
        
        // Notificar al departamento
        $this->notificationService->notifyDepartment(
            $event->getDepartment(),
            "Nuevo empleado contratado: {$event->getName()->value()}"
        );
        
        // Crear registro inicial de nómina
        $this->payrollService->createInitialPayroll($event->getEmployeeId());
    }
}
```

### 3. Saga Pattern
```php
// Application/Saga/EmployeeOnboardingSaga.php
class EmployeeOnboardingSaga implements Saga
{
    private EmployeeId $employeeId;
    private SagaStatus $status;
    private array $completedSteps = [];
    
    public function start(EmployeeHired $event): void
    {
        $this->employeeId = $event->getEmployeeId();
        $this->status = SagaStatus::IN_PROGRESS;
        
        // Paso 1: Crear cuenta de email corporativo
        $this->createCorporateEmail();
    }
    
    public function handle(CorporateEmailCreated $event): void
    {
        if ($event->getEmployeeId()->equals($this->employeeId)) {
            $this->completedSteps[] = 'email_created';
            $this->assignWorkstation();
        }
    }
    
    public function handle(WorkstationAssigned $event): void
    {
        if ($event->getEmployeeId()->equals($this->employeeId)) {
            $this->completedSteps[] = 'workstation_assigned';
            $this->scheduleOrientation();
        }
    }
    
    private function createCorporateEmail(): void
    {
        $command = new CreateCorporateEmailCommand($this->employeeId);
        $this->commandBus->dispatch($command);
    }
    
    private function assignWorkstation(): void
    {
        $command = new AssignWorkstationCommand($this->employeeId);
        $this->commandBus->dispatch($command);
    }
    
    private function scheduleOrientation(): void
    {
        $command = new ScheduleOrientationCommand($this->employeeId);
        $this->commandBus->dispatch($command);
        $this->status = SagaStatus::COMPLETED;
    }
}
```

---

## 🎨 Frontend (Vue.js 3)

### 1. Estructura de Componentes
```
src/
├── components/
│   ├── Employee/
│   │   ├── EmployeeCard.vue
│   │   ├── EmployeeForm.vue
│   │   ├── EmployeeList.vue
│   │   └── EmployeeDetails.vue
│   ├── Payroll/
│   │   ├── PayrollCard.vue
│   │   ├── PayrollCalculator.vue
│   │   └── PayrollHistory.vue
│   ├── Vacation/
│   │   ├── VacationRequest.vue
│   │   ├── VacationCalendar.vue
│   │   └── VacationApproval.vue
│   ├── Dashboard/
│   │   ├── MetricsCard.vue
│   │   ├── EmployeeChart.vue
│   │   └── PayrollSummary.vue
│   └── Common/
│       ├── BaseButton.vue
│       ├── BaseInput.vue
│       └── BaseModal.vue
├── views/
│   ├── Dashboard.vue
│   ├── Employees.vue
│   ├── Payroll.vue
│   ├── Vacations.vue
│   └── Reports.vue
├── stores/
│   ├── employee.js
│   ├── payroll.js
│   ├── vacation.js
│   └── notification.js
└── services/
    ├── api.js
    ├── websocket.js
    └── eventBus.js
```

### 2. Estado Global (Pinia)
```javascript
// stores/employee.js
import { defineStore } from 'pinia'
import { employeeApi } from '@/services/api'

export const useEmployeeStore = defineStore('employee', {
  state: () => ({
    employees: [],
    currentEmployee: null,
    loading: false,
    error: null
  }),
  
  actions: {
    async fetchEmployees(filters = {}) {
      this.loading = true
      try {
        const response = await employeeApi.getEmployees(filters)
        this.employees = response.data
      } catch (error) {
        this.error = error.message
      } finally {
        this.loading = false
      }
    },
    
    async hireEmployee(employeeData) {
      try {
        const response = await employeeApi.hireEmployee(employeeData)
        await this.fetchEmployees() // Refresh list
        return response.data
      } catch (error) {
        this.error = error.message
        throw error
      }
    }
  }
})
```

### 3. Componente de Dashboard
```vue
<!-- views/Dashboard.vue -->
<template>
  <div class="dashboard">
    <div class="metrics-grid">
      <MetricsCard 
        title="Empleados Activos"
        :value="metrics.activeEmployees"
        icon="users"
      />
      <MetricsCard 
        title="Nóminas Pendientes"
        :value="metrics.pendingPayrolls"
        icon="document-text"
      />
      <MetricsCard 
        title="Vacaciones Aprobadas"
        :value="metrics.approvedVacations"
        icon="calendar"
      />
      <MetricsCard 
        title="Contrataciones Este Mes"
        :value="metrics.monthlyHires"
        icon="user-plus"
      />
    </div>
    
    <div class="charts-section">
      <EmployeeChart 
        :data="employeeData"
        @employee-selected="handleEmployeeSelection"
      />
      <PayrollSummary 
        :data="payrollData"
        @payroll-generated="handlePayrollGeneration"
      />
    </div>
    
    <NotificationPanel 
      :notifications="notifications"
      @mark-read="markAsRead"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useEmployeeStore } from '@/stores/employee'
import { usePayrollStore } from '@/stores/payroll'
import MetricsCard from '@/components/Dashboard/MetricsCard.vue'
import EmployeeChart from '@/components/Dashboard/EmployeeChart.vue'
import PayrollSummary from '@/components/Dashboard/PayrollSummary.vue'
import NotificationPanel from '@/components/Dashboard/NotificationPanel.vue'

const employeeStore = useEmployeeStore()
const payrollStore = usePayrollStore()

const metrics = ref({})
const employeeData = ref([])
const payrollData = ref([])
const notifications = ref([])

onMounted(async () => {
  await loadDashboardData()
  initializeEventListeners()
})

const loadDashboardData = async () => {
  await Promise.all([
    employeeStore.fetchEmployees(),
    payrollStore.fetchPayrolls(),
    loadMetrics(),
    loadChartsData()
  ])
}

const initializeEventListeners = () => {
  // Escuchar eventos de dominio desde WebSocket
  eventBus.on('EmployeeHired', handleEmployeeHired)
  eventBus.on('PayrollGenerated', handlePayrollGenerated)
  eventBus.on('VacationApproved', handleVacationApproved)
}
</script>
```

---

## 🔌 APIs REST

### 1. Endpoints Principales
```php
// Api/Controller/EmployeeController.php
#[Route('/api/employees')]
class EmployeeController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getEmployees(GetEmployeesQuery $query): JsonResponse
    {
        $employees = $this->queryBus->dispatch($query);
        return $this->json($employees);
    }
    
    #[Route('', methods: ['POST'])]
    public function hireEmployee(HireEmployeeCommand $command): JsonResponse
    {
        $employeeId = $this->commandBus->dispatch($command);
        return $this->json(['id' => $employeeId], 201);
    }
    
    #[Route('/{id}', methods: ['GET'])]
    public function getEmployee(string $id): JsonResponse
    {
        $employee = $this->queryBus->dispatch(new GetEmployeeQuery($id));
        return $this->json($employee);
    }
    
    #[Route('/{id}/terminate', methods: ['POST'])]
    public function terminateEmployee(string $id, TerminateEmployeeCommand $command): JsonResponse
    {
        $this->commandBus->dispatch($command);
        return $this->json(['message' => 'Employee terminated successfully']);
    }
}

// Api/Controller/PayrollController.php
#[Route('/api/payrolls')]
class PayrollController extends AbstractController
{
    #[Route('/generate', methods: ['POST'])]
    public function generatePayroll(GeneratePayrollCommand $command): JsonResponse
    {
        $payrollId = $this->commandBus->dispatch($command);
        return $this->json(['id' => $payrollId], 201);
    }
    
    #[Route('/{id}/approve', methods: ['POST'])]
    public function approvePayroll(string $id): JsonResponse
    {
        $this->commandBus->dispatch(new ApprovePayrollCommand($id));
        return $this->json(['message' => 'Payroll approved successfully']);
    }
}
```

### 2. Documentación OpenAPI
```yaml
# config/api_platform/resources.yaml
resources:
    App\Api\DTO\EmployeeDTO:
        attributes:
            normalization_context:
                groups: ['employee:read']
            denormalization_context:
                groups: ['employee:write']
        operations:
            ApiPlatform\Metadata\GetCollection:
                filters: ['employee.search_filter']
            ApiPlatform\Metadata\Post:
                security: "is_granted('ROLE_HR_MANAGER')"
    
    App\Api\DTO\PayrollDTO:
        attributes:
            normalization_context:
                groups: ['payroll:read']
        operations:
            ApiPlatform\Metadata\GetCollection:
                security: "is_granted('ROLE_HR_MANAGER')"
```

---

## 🧪 Testing

### 1. Unit Tests (Domain)
```php
// tests/Domain/Employee/EmployeeTest.php
class EmployeeTest extends TestCase
{
    public function test_can_hire_employee(): void
    {
        $employee = Employee::hire(
            EmployeeName::fromString('Juan Pérez'),
            EmployeeEmail::fromString('juan.perez@company.com'),
            EmployeeSalary::fromMoney(new Money(50000, 'EUR')),
            Department::fromString('IT'),
            Position::fromString('Senior Developer')
        );
        
        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertEquals('Juan Pérez', $employee->getName()->value());
        $this->assertEquals(EmployeeStatus::ACTIVE, $employee->getStatus());
        $this->assertCount(1, $employee->getDomainEvents());
    }
    
    public function test_can_terminate_employee(): void
    {
        $employee = $this->createEmployee();
        $employee->terminate(TerminationReason::RESIGNATION);
        
        $this->assertEquals(EmployeeStatus::TERMINATED, $employee->getStatus());
        $this->assertCount(1, $employee->getDomainEvents());
    }
    
    public function test_can_change_salary(): void
    {
        $employee = $this->createEmployee();
        $newSalary = EmployeeSalary::fromMoney(new Money(55000, 'EUR'));
        
        $employee->changeSalary($newSalary);
        
        $this->assertEquals($newSalary, $employee->getSalary());
        $this->assertCount(1, $employee->getDomainEvents());
    }
}
```

### 2. Integration Tests
```php
// tests/Application/Employee/HireEmployeeTest.php
class HireEmployeeTest extends KernelTestCase
{
    public function test_can_hire_employee_through_application_service(): void
    {
        $command = new HireEmployeeCommand(
            'María García',
            'maria.garcia@company.com',
            new Money(45000, 'EUR'),
            'Marketing',
            'Marketing Manager'
        );
        
        $employeeId = $this->commandBus->dispatch($command);
        
        $this->assertNotNull($employeeId);
        
        // Verificar que se publicó el evento de dominio
        $this->assertEventDispatched(EmployeeHired::class);
    }
}
```

### 3. Event Handler Tests
```php
// tests/Infrastructure/EventHandler/EmployeeHiredHandlerTest.php
class EmployeeHiredHandlerTest extends TestCase
{
    public function test_handles_employee_hired_event(): void
    {
        $event = new EmployeeHired(
            EmployeeId::generate(),
            EmployeeName::fromString('Ana López'),
            EmployeeEmail::fromString('ana.lopez@company.com'),
            Department::fromString('Sales'),
            new \DateTimeImmutable()
        );
        
        $this->emailService->expects($this->once())
            ->method('sendWelcomeEmail')
            ->with($event->getEmail());
        
        $this->notificationService->expects($this->once())
            ->method('notifyDepartment')
            ->with($event->getDepartment(), $this->stringContains('Ana López'));
        
        $this->handler->handle($event);
    }
}
```

---

## 🚀 Criterios de Evaluación

### Excelente (90-100 puntos)
- ✅ **Implementación completa y funcional** de todas las funcionalidades
- ✅ **Arquitectura DDD bien implementada** con separación clara de capas
- ✅ **Event-Driven Architecture** correctamente implementada
- ✅ **CQRS** implementado con separación de comandos y consultas
- ✅ **Event Sourcing** para auditoría completa
- ✅ **Sagas** para procesos complejos
- ✅ **Frontend moderno y responsive** con Vue.js 3
- ✅ **APIs REST completas** con documentación
- ✅ **Tests exhaustivos** (unit, integration, event handlers)
- ✅ **Código limpio** y bien documentado

### Muy Bueno (80-89 puntos)
- ✅ **Implementación funcional** de funcionalidades principales
- ✅ **Arquitectura DDD** implementada correctamente
- ✅ **Domain Events** implementados
- ✅ **CQRS básico** implementado
- ✅ **Frontend funcional** con componentes reutilizables
- ✅ **APIs REST** implementadas
- ✅ **Tests adecuados** (unit e integration)

### Bueno (70-79 puntos)
- ✅ **Implementación básica** de funcionalidades core
- ✅ **Estructura DDD** reconocible
- ✅ **Algunos Domain Events** implementados
- ✅ **Frontend básico** funcional
- ✅ **APIs básicas** implementadas
- ✅ **Tests básicos** presentes

### Aceptable (60-69 puntos)
- ✅ **Implementación parcial** de funcionalidades
- ✅ **Estructura de proyecto** organizada
- ✅ **Frontend básico** presente
- ✅ **Algunas APIs** implementadas
- ✅ **Tests mínimos** presentes

### Insuficiente (<60 puntos)
- ❌ **Implementación incompleta** o no funcional
- ❌ **Estructura deficiente** o desorganizada
- ❌ **Frontend ausente** o muy básico
- ❌ **APIs no implementadas**
- ❌ **Tests ausentes**

---

## 📦 Entregables Requeridos

### 1. Código Fuente
- ✅ Repositorio Git con commits significativos
- ✅ README.md con instrucciones de instalación
- ✅ Documentación técnica del proyecto

### 2. Documentación
- ✅ **Arquitectura del sistema** (diagramas, decisiones técnicas)
- ✅ **Event-Driven Architecture** (flujo de eventos, handlers)
- ✅ **CQRS Implementation** (separación de comandos/consultas)
- ✅ **API Documentation** (OpenAPI/Swagger)
- ✅ **Guía de instalación** y configuración

### 3. Testing
- ✅ **Tests unitarios** (mínimo 80% cobertura)
- ✅ **Tests de integración**
- ✅ **Tests de event handlers**
- ✅ **Tests de APIs**

### 4. Deployment
- ✅ **Docker Compose** para desarrollo
- ✅ **Scripts de instalación**
- ✅ **Variables de entorno** configuradas

---

## 🎯 Puntos Extra (Opcional)

### Funcionalidades Avanzadas
- ✅ **Event Sourcing** completo con reconstrucción de estado
- ✅ **CQRS** con bases de datos separadas (write/read models)
- ✅ **Sagas** complejas para procesos de onboarding
- ✅ **Projections** para vistas optimizadas
- ✅ **Event Store** con persistencia de eventos
- ✅ **Real-time notifications** con WebSockets
- ✅ **CI/CD pipeline** completo
- ✅ **Monitoring y logging** avanzado

### Optimizaciones
- ✅ **Caching** avanzado (Redis, Varnish)
- ✅ **Database optimization** (índices, particionamiento)
- ✅ **Performance testing** con JMeter/K6
- ✅ **Event replay** para debugging

---

## 🚀 Instrucciones de Inicio

### 1. Configuración Inicial
```bash
# Clonar el proyecto
git clone <repository-url>
cd hrm-system

# Instalar dependencias
composer install
npm install

# Configurar base de datos
cp .env.example .env
# Editar .env con configuración de BD

# Ejecutar migraciones
php bin/console doctrine:migrations:migrate

# Cargar fixtures (datos de prueba)
php bin/console doctrine:fixtures:load

# Iniciar servidor de desarrollo
symfony server:start
npm run dev
```

### 2. Estructura de Base de Datos
```sql
-- Tabla de empleados
CREATE TABLE employees (
    id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    salary_amount DECIMAL(10,2) NOT NULL,
    salary_currency VARCHAR(3) NOT NULL,
    status VARCHAR(20) NOT NULL,
    department VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    hired_at DATETIME NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);

-- Tabla de nóminas
CREATE TABLE payrolls (
    id VARCHAR(36) PRIMARY KEY,
    employee_id VARCHAR(36) NOT NULL,
    period_start DATE NOT NULL,
    period_end DATE NOT NULL,
    gross_salary_amount DECIMAL(10,2) NOT NULL,
    gross_salary_currency VARCHAR(3) NOT NULL,
    net_salary_amount DECIMAL(10,2) NOT NULL,
    net_salary_currency VARCHAR(3) NOT NULL,
    taxes_amount DECIMAL(10,2) NOT NULL,
    bonuses_amount DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) NOT NULL,
    created_at DATETIME NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- Tabla de eventos de dominio
CREATE TABLE domain_events (
    id VARCHAR(36) PRIMARY KEY,
    aggregate_id VARCHAR(36) NOT NULL,
    aggregate_type VARCHAR(255) NOT NULL,
    event_name VARCHAR(255) NOT NULL,
    event_data JSON NOT NULL,
    occurred_on DATETIME NOT NULL,
    version INT NOT NULL
);

-- Tabla de proyecciones (CQRS)
CREATE TABLE employee_projections (
    id VARCHAR(36) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    department VARCHAR(100) NOT NULL,
    position VARCHAR(100) NOT NULL,
    status VARCHAR(20) NOT NULL,
    last_updated DATETIME NOT NULL
);
```

### 3. Comandos Útiles
```bash
# Generar entidades
php bin/console make:entity

# Crear migraciones
php bin/console make:migration

# Ejecutar tests
php bin/phpunit

# Analizar código
./vendor/bin/phpstan analyse
./vendor/bin/php-cs-fixer fix

# Generar documentación API
php bin/console api:openapi:export

# Replay eventos (Event Sourcing)
php bin/console event-store:replay
```

---

## 📞 Soporte y Consultas

Durante la prueba, puedes consultar:
- ✅ **Documentación oficial** de Symfony y Vue.js
- ✅ **Stack Overflow** para problemas específicos
- ✅ **GitHub** para ejemplos de código
- ❌ **No está permitido** copiar código completo de otros proyectos

---

## 🎯 Evaluación Final

La evaluación se basará en:
1. **Funcionalidad** (35%): ¿El sistema funciona correctamente?
2. **Arquitectura** (30%): ¿Se aplica DDD y Event-Driven correctamente?
3. **Event-Driven** (20%): ¿Los eventos de dominio están bien implementados?
4. **Calidad de código** (10%): ¿El código es limpio y mantenible?
5. **Testing** (5%): ¿Hay tests adecuados?

**¡Buena suerte! 🚀** 