# 🐾 Petstore App – Laravel + Swagger API

Aplikacja demonstracyjna CRUD dla zwierzaków, zbudowana w Laravel 12, z wykorzystaniem zewnętrznego API [Swagger Petstore](https://petstore.swagger.io/). Pozwala na zarządzanie zasobami `/pet` – tworzenie, edycję, usuwanie i przeglądanie.

## ✨ Funkcje

- Autoryzacja i rejestracja użytkownika (Laravel Breeze)
- Lista zwierzaków z filtrem po statusie
- Formularz dodawania i edycji z obsługą pól
- Komunikaty walidacyjne i odpowiedzi z API w języku polskim
- Integracja z API: `https://petstore.swagger.io/v2`

## 🧱 Stack technologiczny

- **Laravel 12**
- **Livewire** (częściowo)
- **Tailwind CSS**
- **Swagger Petstore API**
- **Breeze (auth)**

## ⚙️ Instalacja

```bash
git clone https://github.com/Jacob-repo/petstore-api.git
cd petstore-app

composer install
cp .env.example .env
php artisan key:generate

npm install && npm run dev
php artisan migrate
php artisan serve
```

## 🔐 Logowanie

Zarejestruj konto, aby uzyskać dostęp do panelu.


## 🚀 API Źródłowe

Swagger Petstore

Endpointy:
- GET /pet/findByStatus,
- GET /pet/{id},
- POST /pet,
- PUT /pet,
- DELETE /pet/{id}

