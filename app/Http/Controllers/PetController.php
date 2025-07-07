<?php

namespace App\Http\Controllers;

use App\Services\PetstoreService;
use Illuminate\Http\Request;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

class PetController extends Controller
{
    public function __construct(protected PetstoreService $petstore) {}

    public function index(Request $request)
    {
        $status = $request->input('status', 'available');
        $response = $this->petstore->findByStatus($status);

        if ($response->status() === 400) {
            return back()->withErrors([
                'error' => 'Nieprawidłowy status.'
            ]);
        }

        if ($response->failed()) {
            return back()->withErrors([
                'error' => 'Nie udało się pobrać listy zwierzaków. Kod: ' . $response->status()
            ]);
        }

        $pets = $response->json();
        return view('pets.index', compact('pets', 'status'));
    }

    public function show($id)
    {
        $response = $this->petstore->getPet($id);

        if ($response->status() === 400) {
            return back()->withErrors(['error' => 'Nieprawidłowe ID.']);
        }

        if ($response->status() === 404) {
            return back()->withErrors(['error' => 'Zwierzak nie został znaleziony.']);
        }

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Błąd podczas pobierania szczegółów. Kod: ' . $response->status()]);
        }

        return view('pets.show', ['pet' => $response->json()]);
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(StorePetRequest $request)
    {
        $response = $this->petstore->createPet($request->validated());

        if ($response->status() === 405) {
            return back()->withErrors([
                'error' => 'Błędne dane wejściowe. Upewnij się, że wypełniłeś poprawnie wszystkie pola.'
            ]);
        }

        if ($response->failed()) {
            return back()->withErrors([
                'error' => 'Wystąpił błąd podczas dodawania zwierzaka. Kod: ' . $response->status()
            ]);
        }

        return redirect()->route('pets.index')->with('success', 'Zwierzak został dodany pomyślnie.');
    }

    public function edit($id)
    {
        $response = $this->petstore->getPet($id);

        if ($response->status() === 400) {
            return back()->withErrors(['error' => 'Nieprawidłowe ID.']);
        }

        if ($response->status() === 404) {
            return back()->withErrors(['error' => 'Zwierzak nie został znaleziony.']);
        }

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Błąd podczas pobierania danych do edycji. Kod: ' . $response->status()]);
        }

        return view('pets.edit', ['pet' => $response->json()]);
    }

    public function update(UpdatePetRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = $id;

        $response = $this->petstore->updatePet($data);

        if ($response->status() === 400) {
            return back()->withErrors(['error' => 'Nieprawidłowe ID.']);
        }

        if ($response->status() === 404) {
            return back()->withErrors(['error' => 'Zwierzak nie został znaleziony.']);
        }

        if ($response->status() === 405) {
            return back()->withErrors(['error' => 'Nieprawidłowe dane wejściowe. Sprawdź formularz.']);
        }

        if ($response->failed()) {
            return back()->withErrors([
                'error' => 'Wystąpił błąd podczas aktualizacji. Kod: ' . $response->status()
            ]);
        }

        return redirect()->route('pets.show', $id)->with('success', 'Zwierzak został zaktualizowany.');
    }

    public function destroy($id)
    {
        $response = $this->petstore->deletePet($id);

        if ($response->status() === 400) {
            return back()->withErrors(['error' => 'Nieprawidłowe ID.']);
        }

        if ($response->status() === 404) {
            return back()->withErrors(['error' => 'Zwierzak nie został znaleziony.']);
        }

        if ($response->failed()) {
            return back()->withErrors([
                'error' => 'Wystąpił błąd podczas usuwania. Kod: ' . $response->status()
            ]);
        }

        return redirect()->route('pets.index')->with('success', 'Zwierzak został usunięty.');
    }
}
