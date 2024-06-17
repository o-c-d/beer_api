<?php

declare(strict_types=1);

namespace App\Application\Command\Biere;


use App\Domain\Store\BiereStore;
use App\Domain\Store\BrasserieStore;
use App\Domain\Store\CategorieStore;
use App\Domain\Store\StyleStore;
use App\Domain\Store\UtilisateurStore;
use App\Entity\Biere;
use App\Entity\Brasserie;
use App\Entity\Categorie;
use App\Entity\Style;
use App\Entity\Utilisateur;
use App\State\UtilisateurPasswordHasher;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class BiereImportHandler
{
    public function __construct(
        private BiereStore $biereStore,
        private BrasserieStore $brasserieStore,
        private CategorieStore $categorieStore,
        private StyleStore $styleStore,
        private UtilisateurStore $utilisateurStore,
        private UtilisateurPasswordHasher $passwordHasher,
    ) {
    }

    public function __invoke(BiereImport $command): void
    {

        $biere = $this->biereStore->findOneBy(['biereId'=>$command->id]);

        if (null === $biere) {

            $brasserie = $this->brasserieStore->findOneBy(['breweryId'=>$command->breweryId]);
            if (null === $brasserie) {
                $brasserie = new Brasserie(
                    $command->breweryId,
                    $command->brewer,
                    $command->address,
                    $command->city,
                    $command->country,
                );
                $this->brasserieStore->save($brasserie);
            }
    
            $categorie = $this->categorieStore->findOneBy(['categorieId'=>$command->catId]);
            if (null === $categorie) {
                $categorie = new Categorie(
                    $command->catId,
                    $command->category,
                );
                $this->categorieStore->save($categorie);
            }
    
            $style = $this->styleStore->findOneBy(['styleId'=>$command->styleId]);
            if (null === $style) {
                $style = new Style(
                    $command->styleId,
                    $command->style,
                );
                $this->styleStore->save($style);
            }
    
            $author = $this->utilisateurStore->findOneBy(['authorId'=>$command->addUser]);
            if (null === $author) {
                $author = new Utilisateur(
                    $command->addUser,
                    "author_" . $command->addUser . "@import.dev",
                    "password_" . $command->addUser,
                    "author_" . $command->addUser,
                );
                $this->utilisateurStore->save($author);
            }

            $biere = new Biere(
                $command->id,
                $command->name,
                $command->alcoholByVolume,
                $command->internationalBitternessUnits,
                $brasserie,
                $categorie,
                $style,
                $author,
                $command->description,
            );
            $this->biereStore->save($biere, true);
        }
    }
}